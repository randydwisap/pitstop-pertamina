<x-filament-panels::page>
    <x-filament::section>
        <form id="edit-profile-form" wire:submit.prevent="save" class="space-y-6">
            {{ $this->form }}
        </form>

        {{-- Footer bawaan section -> spacing & border-nya otomatis rapi --}}
        <x-slot name="footer">
            <div class="ml-auto">
                <x-filament::button type="submit" form="edit-profile-form">
                    Simpan Perubahan
                </x-filament::button>
            </div>
        </x-slot>
    </x-filament::section>
</x-filament-panels::page>
