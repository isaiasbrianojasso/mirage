<div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow group">
    <a href="{{ $link }}" class="block">
        <div class="relative h-48">
            @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 100-4 2 2 0 000 4zm-6 0a2 2 0 100-4 2 2 0 000 4zm6 8a2 2 0 100-4 2 2 0 000 4zm-6 0a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
            @endif
            @if($badge)
                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">{{ $badge }}</span>
            @endif
        </div>
        <div class="p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2 line-clamp-2">{{ $title }}</h3>
            @if($price)
                <p class="text-xl font-bold text-a00000 mb-2">${{ $price }}</p>
            @endif
            @if($rating)
                <div class="flex mb-2">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-yellow-400 mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="{{ $i < $rating ? 'M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.303 4.015a.99.99 0 001.82.557l3.096-.52a.99.99 0 00.95-1.306l-2.43-2.293a.99.99 0 00-1.82-.55L9.049 7.93l-.691-2.88a1 1 0 00-1.82.55l-2.43 2.293a.99.99 0 00-.95 1.306l3.096.52a.99.99 0 001.82.557l1.303-4.015z' : 'M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.303 4.015a.99.99 0 001.82.557l3.096-.52a.99.99 0 00.95-1.306l-2.43-2.293a.99.99 0 00-1.82-.55L9.049 7.93l-.691-2.88a1 1 0 00-1.82.55l-2.43 2.293a.99.99 0 00-.95 1.306l3.096.52a.99.99 0 001.82.557l1.303-4.015z' }}"></path>
                        </svg>
                    @endfor
                </div>
            @endif
            @if($description)
                <p class="text-sm text-gray-500 line-clamp-2">{{ $description }}</p>
            @endif
        </div>
    </a>
</div>
