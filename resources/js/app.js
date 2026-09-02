import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

/**
 * Renders a Bootstrap toast whenever a Livewire component dispatches a `toast`
 * browser event. Replaces the toast channel previously provided by Flux.
 */
window.addEventListener('toast', (event) => {
    const container = document.querySelector('[data-toast-container]');

    if (! container) {
        return;
    }

    const { text = '', variant = 'info' } = event.detail ?? {};

    const element = document.createElement('div');

    element.className = `toast align-items-center text-bg-${variant} border-0`;
    element.setAttribute('role', 'alert');
    element.setAttribute('aria-live', 'assertive');
    element.setAttribute('aria-atomic', 'true');
    element.innerHTML = `
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    element.querySelector('.toast-body').textContent = text;

    container.appendChild(element);

    const toast = new bootstrap.Toast(element, { delay: 4000 });

    element.addEventListener('hidden.bs.toast', () => element.remove());

    toast.show();
});

/**
 * Reveals or hides the value of a password field. Delegated from the document so
 * it keeps working across `wire:navigate` visits and Livewire re-renders.
 */
document.addEventListener('click', (event) => {
    const toggle = event.target.closest('[data-password-toggle]');

    if (! toggle) {
        return;
    }

    const input = toggle.closest('.input-group')?.querySelector('input');

    if (! input) {
        return;
    }

    const revealed = input.type === 'text';

    input.type = revealed ? 'password' : 'text';
    toggle.querySelector('[data-password-toggle-show]')?.classList.toggle('d-none', ! revealed);
    toggle.querySelector('[data-password-toggle-hide]')?.classList.toggle('d-none', revealed);
});

/**
 * Copies the value of the referenced input and briefly swaps the button icon.
 */
document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-clipboard-copy]');

    if (! button) {
        return;
    }

    const source = document.querySelector(button.dataset.clipboardCopy);

    if (! source) {
        return;
    }

    try {
        await navigator.clipboard.writeText(source.value);
    } catch {
        return;
    }

    const idle = button.querySelector('[data-clipboard-idle]');
    const done = button.querySelector('[data-clipboard-done]');

    idle?.classList.add('d-none');
    done?.classList.remove('d-none');

    setTimeout(() => {
        idle?.classList.remove('d-none');
        done?.classList.add('d-none');
    }, 1500);
});

/**
 * Swaps between the authenticator code and the recovery code panels on the
 * two-factor challenge screen.
 */
document.addEventListener('click', (event) => {
    const toggle = event.target.closest('[data-otp-mode-toggle]');

    if (! toggle) {
        return;
    }

    const form = toggle.closest('[data-otp-modes]');

    if (! form) {
        return;
    }

    const next = form.dataset.otpModes === 'code' ? 'recovery' : 'code';

    form.dataset.otpModes = next;

    form.querySelectorAll('[data-otp-mode]').forEach((panel) => {
        const active = panel.dataset.otpMode === next;

        panel.classList.toggle('d-none', ! active);
        panel.querySelectorAll('input').forEach((input) => {
            input.value = '';
            input.required = active;
            input.disabled = ! active;
        });
    });

    document.querySelectorAll('[data-otp-mode-header]').forEach((header) => {
        header.classList.toggle('d-none', header.dataset.otpModeHeader !== next);
    });

    document.querySelectorAll('[data-otp-mode-label]').forEach((label) => {
        label.classList.toggle('d-none', label.dataset.otpModeLabel !== next);
    });

    form.querySelector(`[data-otp-mode="${next}"] input`)?.focus();
});

/**
 * Applies the stored colour scheme. The initial application happens inline in
 * the document head to avoid a flash of the wrong theme.
 */
const applyTheme = (preference) => {
    const resolved = preference === 'system'
        ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
        : preference;

    document.documentElement.setAttribute('data-bs-theme', resolved);
};

document.addEventListener('change', (event) => {
    const input = event.target.closest('[data-theme-value]');

    if (! input) {
        return;
    }

    const preference = input.dataset.themeValue;

    localStorage.setItem('appearance', preference);

    applyTheme(preference);
});

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if ((localStorage.getItem('appearance') ?? 'system') === 'system') {
        applyTheme('system');
    }
});

/**
 * Reflects the stored colour scheme on the appearance settings radios, on both
 * a cold load and a `wire:navigate` visit.
 */
const syncThemeInputs = () => {
    const preference = localStorage.getItem('appearance') ?? 'system';

    document.querySelectorAll('[data-theme-value]').forEach((input) => {
        input.checked = input.dataset.themeValue === preference;
    });
};

document.addEventListener('DOMContentLoaded', syncThemeInputs);
document.addEventListener('livewire:navigated', syncThemeInputs);
