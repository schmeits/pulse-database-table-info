<?php

namespace Schmeits\PulseDatabaseTableSizes\Recorders;

use Illuminate\Config\Repository;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Laravel\Pulse\Events\SharedBeat;
use Laravel\Pulse\Pulse;
use Schmeits\PulseDatabaseTableSizes\Exceptions\DatabaseNotSupported;

class TableSizesRecorder
{
    public string $listen = SharedBeat::class;

    /**
     * Create a new recorder instance.
     */
    public function __construct(
        protected Pulse $pulse,
        protected Repository $config
    ) {
        //
    }

    public function record(SharedBeat $event): void
    {
        $this->pulse->lazy(function () {
            $connectionName = $this->getDefaultConnectionName();

            $connection = app(ConnectionResolverInterface::class)->connection($connectionName);

            $results = $this->getTableSizes($connection);

            $results = collect($results)->map(function ($obj) {
                return [
                    'name' => $obj->tablename,
                    'size' => $obj->size,
                ];
            })->toJson();

            json_decode($results, flags: JSON_THROW_ON_ERROR);

            $this->pulse->set('database-tables-sizes', 'result', $results);
        });
    }

    protected function getDefaultConnectionName(): string
    {
        return config('database.default');
    }

    private function getTableSizes(ConnectionInterface $connection): array
    {
        return match (true) {
            $connection instanceof MySqlConnection => $this->getTableSizesMysql($connection),
            $connection instanceof PostgresConnection => $this->getTableSizesPostgres($connection),
            default => throw DatabaseNotSupported::make($connection),
        };
    }

    private function getTableSizesMysql(ConnectionInterface $connection): array
    {
        return $connection->select(
            'SELECT table_name as tablename, (data_length + index_length) AS size FROM information_schema.TABLES WHERE table_schema = ?',
            [$connection->getDatabaseName()]
        );
    }

    private function getTableSizesPostgres(ConnectionInterface $connection): array
    {
        return $connection->select('SELECT relname AS "tablename", pg_total_relation_size(relid) AS "size" FROM pg_catalog.pg_statio_user_tables');
    }
}
