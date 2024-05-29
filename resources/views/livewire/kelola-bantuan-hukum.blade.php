<div>
    <span class="font-semibold">Show entries:</span>
    <select wire:model="entries" wire:click="updateEntries">
        @foreach ($showEntriesOptions as $option)
            <option>{{ $option }}</option>
        @endforeach
    </select>
</div>
