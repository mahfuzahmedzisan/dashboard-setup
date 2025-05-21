@props(['url' => null, 'method' => '', 'placeholder' => 'Search'])


<form action="{{ $url }}" method="{{ $method }}" class="w-full">
    <div x-data="{
        focus: false,
        value: '',
        init() {
            window.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    this.$refs.search.focus();
                }
            });
        }
    }" x-init="init()"
        class="searchForm transition-all duration-300 ease-in-out scale-95 max-w-[500px] min-w-64 lg:min-w-96 z-50">
        <x-admin.search-input :placeholder="$placeholder" />
    </div>
</form>
