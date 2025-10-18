<x-filament-panels::page>
    <x-filament::section>
        <form wire:submit.prevent="save" class="space-y-6">
            {{ $this->form }}

            <div class="flex justify-end pt-4 border-t mt-6">
                <x-filament::button type="submit">
                    Simpan Perubahan
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>
</x-filament-panels::page>
