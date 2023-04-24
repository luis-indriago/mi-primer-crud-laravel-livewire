<div>
    <a href="#" class="btn btn-green ml-3" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar post
        </x-slot>
        
        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="block sm:inline">Su imagen se cargara en un momento</span>

            </div>

            @if ($image)
                <img src=" {{ $image->temporaryUrl() }} " class="mb-4"><img/>
            @else
                <img src=" {{ Storage::url( $post->image ) }} " class="mb-4"><img/>
            @endif

            <div class="mb-4">
                <x-jet-label value="Título del post"/>
                <x-jet-input wire:model="post.title" type="text" class="w-full"/>
                <x-jet-input-error for="post.title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post"/>
                <textarea wire:model="post.content" name="" class="form-control w-full" rows="6"></textarea>
                <x-jet-input-error for="post.content"/>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-jet-input-error for="image"/>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2 disabled:opacity-25"  wire:click="save" wire:loading.attr="disabled" wire:target="save, image">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
