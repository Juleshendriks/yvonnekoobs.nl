<x-filament-panels::page>
    <div class="space-y-6">
        @if(!$this->record)
            <div class="rounded-lg bg-gray-50 p-6 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                    <x-heroicon-o-user class="h-6 w-6 text-blue-600" />
                </div>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Geen profiel gevonden</h3>
                <p class="mt-1 text-sm text-gray-500">Maak je eerste profiel aan om te beginnen.</p>
            </div>
        @endif

        <form wire:submit="save">
            {{ $this->form }}

            <div class="flex justify-end space-x-2 pt-6">
                <x-filament::button
                    type="submit"
                    size="lg"
                >
                    {{ $this->record ? 'Profiel bijwerken' : 'Profiel aanmaken' }}
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament-panels::page>
