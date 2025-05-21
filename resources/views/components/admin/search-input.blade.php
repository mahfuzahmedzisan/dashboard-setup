@props(['placeholder' => 'Search'])
<div class="join w-full relative" @focusin="focus = true" @focusout="focus = false">
    <input x-ref="search" x-model="value" class="input input-search join-item" placeholder="{{ $placeholder }}" />
    <button class="btn join-item rounded-r-full">
        <i data-lucide="search"></i>
    </button>

    <div class="absolute top-[125%] left-0 w-full max-w-full bg-gray-200 dark:bg-gray-700 z-10 rounded-2xl h-fit max-h-56 overflow-auto"
        x-show="focus" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-3">
        <div class="p-2 text-center">
            <h4 class="font-medium">Search Results <span class="font-normal" x-text="value"></span></h4>
            <div class="divider m-0"></div>
            <p>No results</p>
        </div>
    </div>
</div>
