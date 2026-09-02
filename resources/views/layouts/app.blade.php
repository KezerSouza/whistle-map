<x-layouts::app.sidebar :title="$title ?? null">
    <main class="container-fluid p-4">
        {{ $slot }}
    </main>
</x-layouts::app.sidebar>
