<x-layouts::app :title="__('Dashboard')">
    <div class="d-flex flex-column gap-4">
        <div class="row g-4">
            @for ($tile = 1; $tile <= 3; $tile++)
                <div class="col-md-4">
                    <div class="card overflow-hidden placeholder-tile">
                        <x-placeholder-pattern class="w-100 h-100" style="stroke: var(--bs-border-color)" />
                    </div>
                </div>
            @endfor
        </div>

        <div class="card overflow-hidden" style="min-height: 20rem">
            <x-placeholder-pattern class="w-100 h-100" style="stroke: var(--bs-border-color)" />
        </div>
    </div>
</x-layouts::app>
