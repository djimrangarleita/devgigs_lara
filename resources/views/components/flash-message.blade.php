@if(session()->has('success'))
    <div 
        class="fixed top-0 transform bg-laravel text-white px-48 py-3 left-1/2 transform -translate-x-1/2"
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif