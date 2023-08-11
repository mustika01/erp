@props([
    'color' => 'primary',
])

<div @class([
    'border-l-4 border-t border-r border-b p-4 rounded-lg',
    'bg-primary-50 border-primary-100 border-l-primary-400 dark:bg-primary-900' => $color === 'primary',
    'bg-danger-50 border-danger-100 border-l-danger-400 dark:bg-danger-900' => $color === 'danger',
    'bg-success-50 border-success-100 border-l-success-400 dark:bg-success-900' => $color === 'success',
    'bg-warning-50 border-warning-100 border-l-warning-400 dark:bg-warning-900' => $color === 'warning',
])>
    <div class="flex">
        <div class="flex-shrink-0">
            @if ($color === 'primary')
            <!-- Heroicon name: solid/information-circle -->
            <svg class="h-5 w-5 text-primary-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            @endif
            @if ($color === 'danger')
            <!-- Heroicon name: solid/x-circle -->
            <svg class="h-5 w-5 text-danger-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            @endif
            @if ($color === 'success')
            <!-- Heroicon name: solid/check-circle -->
            <svg class="h-5 w-5 text-success-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            @endif
            @if ($color === 'warning')
            <!-- Heroicon name: solid/exclamation -->
            <svg class="h-5 w-5 text-warning-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            @endif
        </div>
        <div class="ml-3">
            <p @class([
                'text-sm',
                'text-primary-700 dark:text-primary-200' => $color === 'primary',
                'text-success-700 dark:text-success-200' => $color === 'success',
                'text-danger-700 dark:text-danger-200' => $color === 'danger',
                'text-warning-700 dark:text-warning-200' => $color === 'warning',
            ])>
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
