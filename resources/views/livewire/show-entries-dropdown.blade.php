<div>
    <span class="font-semibold">Show entries:</span>
    <select wire:model="entries" class="form-select rounded-md border-gray-300">
        @foreach ($showEntriesOptions as $option)
            <option>{{ $option }}</option>
        @endforeach
    </select>
</div>
