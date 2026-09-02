{{--
    Applies the stored colour scheme before the first paint so the page never
    flashes the wrong theme. Bootstrap reads `data-bs-theme` off the root node.
--}}
<script>
    (() => {
        const preference = localStorage.getItem('appearance') ?? 'system';
        const dark = preference === 'dark'
            || (preference === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
    })();
</script>
