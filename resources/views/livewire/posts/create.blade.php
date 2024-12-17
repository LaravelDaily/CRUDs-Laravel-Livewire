<div class="min-w-full align-middle">
    <form method="POST" wire:submit="save">
        @csrf

        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" required />
            <x-text-input wire:model.live.debounce.1s="title" id="title" class="block mt-1 w-full" type="text" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Slug -->
        <div class="mt-4">
            <x-input-label for="slug" :value="__('Slug')" required />
            <x-text-input wire:model="slug" id="slug" class="block mt-1 w-full" type="text" required />
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
        </div>

        <!-- Body -->
        <div class="mt-4">
            <x-input-label for="body" :value="__('Body')" required />
            <textarea wire:model="body" id="body" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</div>
