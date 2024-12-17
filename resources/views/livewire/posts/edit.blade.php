<div class="min-w-full align-middle">
    <form method="POST" wire:submit="save">
        @csrf

        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" required />
            <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Slug -->
        <div class="mt-4">
            <x-input-label for="slug" :value="__('Slug')" required />
            <x-text-input wire:model="slug" id="slug" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>

        <!-- Body -->
        <div
            x-data="{
                body: @entangle('body')
            }"
            class="mt-4"
        >
            <x-input-label for="body" :value="__('Body')" required />
            <textarea wire:model="body" x-model="body" id="body" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            <div class="flex justify-end mt-1 text-sm text-gray-500">
                <span x-text="body ? body.length : 0">0</span>/1000 characters
            </div>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</div>
