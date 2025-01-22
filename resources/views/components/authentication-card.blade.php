<div class="min-h-screen flex flex-col sm:justify-center items-center pt-10  bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg" style="min-width: 90%;">
        {{ $slot }}
    </div>
</div>
