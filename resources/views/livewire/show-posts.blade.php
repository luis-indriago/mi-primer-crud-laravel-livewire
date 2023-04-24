<div wire:init="loadPost">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- component -->
        <x-table>
            <div class="px-6 py-4 flex item-center">

                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cant" class="mx-2 form-control">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entradas</span>
                </div>

                <x-jet-input class="flex-1 mx-4" placeholder="Escriba que esta buscando" type="text" wire:model="search"></x-jet-input>
            
                @livewire('create-post')
            </div>

            <table class="w-full">
                <thead>
                    <tr
                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase  border-gray-600">
                        <th class="w-24 px-4 py-3 cursor-pointer" wire:click="order('id')">ID

                            {{-- Sort --}}
                            @if ( $sort == 'id' )
                                @if ( $direction == 'asc'  )
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif

                        </th>
                        <th class="px-4 py-3 cursor-pointer" wire:click="order('title')">TITULO 
                            
                            {{-- Sort --}}
                            @if ( $sort == 'title' )
                                @if ( $direction == 'asc'  )
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif

                        </th>
                        <th class="px-4 py-3 cursor-pointer" wire:click="order('content')">CONTENIDO

                            {{-- Sort --}}
                            @if ( $sort == 'content' )
                                @if ( $direction == 'asc'  )
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif

                        </th>
                        <th class="px-4 py-3">EDIT</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($posts as $item)
                        <tr class="text-gray-700 border">
                            <td class="px-4 py-3 text-ms font-semibold">{{ $item->id }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->title }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->content }}</td>
                            <td class="text-sm px-4 py-4 flex">
                               {{-- @livewire( 'edit-post', [ 'post' => $post ], key( $post->id ) ) --}}

                               <a href="#" class="btn btn-green ml-3" wire:click="edit({{$item}})">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="#" class="btn btn-red ml-3" wire:click="$emit('deletePost', {{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        @if ( $readyToLoad )
                            <td colspan="4" class="px-4 py-3 text-md  text-center font-bold">No existe ningún registro que coincida con su busqueda</td>
                        @else
                            <td colspan="4" class="px-4 py-3 text-md content-center font-bold">                          
                                <div role="status">
                                    <svg aria-hidden="true" class="w-full h-8 mr-2 text-gray-200 animate-spin dark:text-gray-300 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        @endif
                        
                    @endforelse

                </tbody>
            </table>        
            @if ( count($posts) )
                @if ( $posts->hasPages() )
                    <div class="px-6 py-3">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif


        </x-table>
        


    </div>

    <x-jet-dialog-modal wire:model="open_edit">
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
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2 disabled:opacity-25"  wire:click="update" wire:loading.attr="disabled" wire:target="save, image">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            livewire.on('deletePost', function(postId){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    livewire.emitTo('show-posts', 'delete', postId)

                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</div>
