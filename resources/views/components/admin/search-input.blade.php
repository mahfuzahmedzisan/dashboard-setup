 @props(['placeholder' => 'Search'])

 <div class="join w-full relative">
     <input x-ref="search" x-model="value" @input="fetchData()"
         class="input input-search join-item focus:outline-0 pl-6 border-border-light-tertiary dark:border-border-dark-tertiary focus-within:outline-0 focus:ring-0 focus:border-border-active focus-within:border-border-active w-full min-w-32 rounded-l-full transition-all duration-200 ease-linear bg-bg-light-primary dark:bg-bg-dark-primary"
         placeholder="{{ $placeholder }}" @focus="focus = true" @blur="focus = false" />

     <button
         class="btn join-item rounded-r-full border-border-light-tertiary dark:border-border-dark-tertiary bg-bg-light-primary dark:bg-bg-dark-primary hover:bg-bg-light-secondary dark:hover:bg-bg-dark-secondary focus:outline-none pl-2 group"
         :class="focus ? '!border-border-active bg-bg-light-secondary dark:bg-bg-dark-secondary' : ''">
         <i data-lucide="search" class="group-hover:text-text-active transition-all duration-200 ease-in-out"
             :class="focus ? 'animate-scalePulse' : ''"></i>
     </button>


     <div class="absolute top-[130%] left-0 w-full max-w-full bg-bg-light-tertiary dark:bg-bg-dark-tertiary z-10 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 ease-in-out"
         x-show="focus && (searchResults.length > 0 || value.length > 0)"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-3">
         <div class="text-center relative h-fit min-h-24 max-h-56 overflow-auto">
             <div class="sticky top-0 z-20 bg-bg-light-tertiary dark:bg-bg-dark-tertiary">
                 <div class="p-2">
                     <h4 class="font-medium">Search Results for "<span class="font-normal" x-text="value"></span>"</h4>
                     <div class="divider m-0"></div>
                 </div>
             </div>

             <div class="p-4 pt-0">
                 <!-- Displaying search results -->
                 <ul class="space-y-2">
                     <template x-for="result in searchResults" :key="result.id">
                         <li>
                             <a href="#"
                                 class="block py-2 px-3 hover:bg-bg-active dark:hover:bg-gray-700 rounded">
                                 <span x-text="result.name"></span>
                             </a>
                         </li>
                     </template>
                 </ul>

                 <!-- No results message -->
                 <div x-show="searchResults.length === 0" class="text-sm text-gray-500 mt-2">
                     No results found.
                 </div>
             </div>
         </div>
     </div>
 </div>
