<?php

namespace Schmeits\Pulse\DatabaseTableInfo\Recorders;

use Illuminate\Config\Repository;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Laravel\Pulse\Events\SharedBeat;
use Laravel\Pulse\Pulse;
use Laravel\Pulse\Recorders\Concerns;
use Schmeits\Pulse\DatabaseTableInfo\Exceptions\DatabaseNotSupported;

class TableInfoRecorder
{
    use Concerns\Ignores;

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

            $results = $this->getTableInfo($connection);

            $results = collect($results)->map(function ($obj) {
                if ($this->shouldIgnore($obj->tablename)) {
                    return [];
                }

                return [
                    'name' => $obj->tablename,
                    'size' => $obj->size,
                    'rows' => $obj->rowcount ?? 0,
                ];
            })->reject(function ($obj) {
                return empty($obj);
            })->toJson();

            json_decode($results, flags: JSON_THROW_ON_ERROR);

            $this->pulse->set('database-tables-info', 'result', $results);
        });
    }

    protected function getDefaultConnectionName(): string
    {
        return config('database.default');
    }

    private function getTableInfo(ConnectionInterface $connection): array
    {
        return match (true) {
            $connection instanceof MySqlConnection => $this->getTableInfoMySql($connection),
            $connection instanceof PostgresConnection => $this->getTableInfoPostgres($connection),
            default => throw DatabaseNotSupported::make($connection),
        };
    }

    private function getTableInfoMySql(ConnectionInterface $connection): array
    {
        return $connection->select(
            'SELECT table_name as tablename, (data_length + index_length) AS size, TABLE_ROWS as rowcount FROM information_schema.TABLES WHERE table_schema = ?',
            [$connection->getDatabaseName()]
        );
    }

    private function getTableInfoPostgres(ConnectionInterface $connection): array
    {
        return $connection->select('SELECT relname AS "tablename", pg_total_relation_size(relid) AS "size", n_live_tup as "rowcount" FROM pg_stat_user_tables');
    }
}
