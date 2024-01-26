<x-pulse::card id="pulse-table-sizes" :cols="$cols" :rows="$rows" :class="$class" wire:poll.5s="">
    <x-pulse::card-header name="Table Sizes">
        <x-slot:icon>
            <x-pulse::icons.circle-stack></x-pulse::icons.circle-stack>
        </x-slot:icon>
        <x-slot:actions>
            <x-pulse::select
                wire:model.live="orderBy"
                label="Sort by"
                :options="[
                    'size' => 'size',
                    'rows' => 'rows',
                    'name' => 'name',
                ]"
                @change="loading = true"
            />
        </x-slot:actions>
    </x-pulse::card-header>

    <x-pulse::scroll :expand="$expand">
        @if ($results->isEmpty())
            <x-pulse::no-results />
        @else
            <x-pulse::table>
                <colgroup>
                    <col width="60%" />
                    <col width="20%" />
                    <col width="20%" />
                </colgroup>
                <x-pulse::thead>
                    <tr>
                        <x-pulse::th>Table name</x-pulse::th>
                        <x-pulse::th>Size</x-pulse::th>
                        <x-pulse::th>Rowcount</x-pulse::th>
                    </tr>
                </x-pulse::thead>
                <tbody>
                @foreach($results as $result)
                    <tr class="h-2 first:h-0"></tr>
                    <tr wire:key="{{ $result->name }}">
                        <x-pulse::td>
                            <code class="block text-xs text-gray-900 dark:text-gray-100 truncate" title="{{ $result->name }}">
                            {{ $result->name }}
                            </code>
                        </x-pulse::td>
                        <x-pulse::td class="text-gray-700 dark:text-gray-300 font-bold">
                            {{ Number::fileSize($result->size, maxPrecision: 3) }}
                        </x-pulse::td>
                        <x-pulse::td class="text-gray-700 dark:text-gray-300 font-bold">
                            {{ $result->rowcount }}
                        </x-pulse::td>
                    </tr>
                @endforeach
                </tbody>
            </x-pulse::table>
        @endif
    </x-pulse::scroll>
</x-pulse::card>
