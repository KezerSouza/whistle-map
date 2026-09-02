@props([
    'show' => false,
    'size' => 'modal-lg',
])

{{--
    Visibility is driven entirely by server state instead of Bootstrap's modal
    JavaScript, so Livewire re-renders can never desync from the DOM.
--}}
<div {{ $attributes->only('class') }}>
    <div
        class="modal fade @if ($show) show @endif"
        style="display: {{ $show ? 'block' : 'none' }}"
        tabindex="-1"
        role="dialog"
        @if ($show) aria-modal="true" @else aria-hidden="true" @endif
    >
        <div class="modal-dialog modal-dialog-centered {{ $size }}">
            <div class="modal-content">
                {{ $slot }}
            </div>
        </div>
    </div>

    @if ($show)
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
