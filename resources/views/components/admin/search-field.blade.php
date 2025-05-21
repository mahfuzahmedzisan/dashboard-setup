@props(['url' => null, 'method' => 'post', 'placeholder' => 'Search'])

<form action="{{ $url }}" method="{{ $method }}" class="w-full">
    <div x-data x-init="window.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            $refs.search.focus();
        }
    })">
        <label class="input flex items-center pr-0">
            <input x-ref="search" type="search" class="grow" placeholder="{{ $placeholder }}" />

            <button type="submit" class="cursor-pointer w-16  h-full flex items-center justify-center">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                        stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
            </button>
        </label>
    </div>
</form>
