@props(["job"])
<x-card-gray>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{ asset($job->logo ? "storage/".$job->logo : "images/no-image.png") }}"
            alt="{{ $job->title }}"
        />
        <div>
            <h3 class="text-2xl">
                <a href="/jobs/{{ $job->id }}">{{ $job->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $job->company }}</div>
            <x-tags :tagsCsv="$job->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
            </div>
        </div>
    </div>
</x-card-gray>