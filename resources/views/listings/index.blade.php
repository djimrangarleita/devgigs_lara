<x-layout>
    @include('partials._hero')
    @include('partials._search_form')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($listings) <= 0)
            <p>No job found</p>
        @else
            @foreach ($listings as $job)
                <x-job-card :job="$job"/>
            @endforeach
        @endif
    </div>
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
</x-layout>