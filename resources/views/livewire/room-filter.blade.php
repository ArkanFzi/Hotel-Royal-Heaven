<div>
    {{-- Filter Section --}}
    <x-filter-section
        :tipeKamars="$tipeKamars"
        :showPriceFilter="true"
        :showDateFilter="true"
        :showCapacityFilter="true"
        :showSortFilter="true"
    />

    {{-- Results Section --}}
    <div class="mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900">Available Rooms</h2>
            <div class="text-sm text-gray-600">
                {{ $kamars->total() }} rooms found
            </div>
        </div>

        {{-- Rooms Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kamars as $kamar)
                <x-room-card :kamar="$kamar" />
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-.98-5.5-2.5m.5-4C6.5 9 4.5 9 4.5 9s2 0 2.5-2.5M19.5 9s-2 0-2.5-2.5m.5 4c.5-2.5 2.5-2.5 2.5-2.5s-2 0-2.5 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No rooms found</h3>
                    <p class="text-gray-600">Try adjusting your search criteria or filters.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($kamars->hasPages())
            <div class="mt-8">
                {{ $kamars->links() }}
            </div>
        @endif
    </div>
</div>
