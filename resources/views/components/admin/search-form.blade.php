@props(['url' => null, 'method' => '', 'placeholder' => 'Search'])
<form action="{{ $url }}" method="{{ $method }}" class="w-full">
    <div x-data="{
        focus: false,
        mobile: false,
        value: '',
        searchResults: [],
        init() {
            window.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    this.$refs.search.focus();
                }
            });
    
            // Check the initial width and update `mobile` state
            this.updateMobileState();
    
            // Listen to window resize events
            window.addEventListener('resize', () => {
                this.updateMobileState();
            });
        },
        updateMobileState() {
            this.mobile = window.innerWidth < 512;
        },
        fetchData() {
            if (this.value.length >= 3) {
                fetch(`http://localhost:8000/temp/search.json?q=${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        this.searchResults = data; // Use data directly instead of data.results
                    })
                    .catch(error => {
                        console.error('Error fetching search data:', error);
                    });
            } else {
                this.searchResults = []; // Clear search results if the input is too short
            }
        }
    }" x-init="init()"
        class="searchForm transition-all duration-300 ease-in-out scale-95 max-w-[500px] min-w-64 lg:min-w-96 z-50">
        <x-admin.search-input :placeholder="$placeholder" />
    </div>
</form>
