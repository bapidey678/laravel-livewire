@if($paginator->hasPages())
    <ul class="flex justify-between">
        @if($paginator->onFirstPage())
            <li class="bg-gray-200 cursor-not-allowed p-2 rounded shadow">Previous Page</li>
        @else
            <li wire:click="previousPage"
                class="cursor-pointer bg-red-400 p-2 rounded shadow">Previous Page</li>
        @endif
        @if($paginator->hasMorePages())
                <li wire:click="nextPage"
                    class="cursor-pointer bg-green-400 p-2 rounded shadow">Next Page</li>
            @else
                <li class="cursor-not-allowed bg-gray-200 p-2 rounded shadow">Next Page</li>
        @endif
    </ul>
@endif
