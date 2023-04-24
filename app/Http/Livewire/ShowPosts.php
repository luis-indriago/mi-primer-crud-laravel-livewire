<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;


class ShowPosts extends Component
{
    use withFileUploads;
    use WithPagination;

    public  $post, $image, $identificador;
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';

    public $cant = '10';
    public $readyToLoad = false;

    public $open_edit = false;

    public $queryString = [
        'cant' => [ 'except' => '10' ], 
        'sort' => [ 'except' => 'id' ], 
        'direction' => [ 'except' => 'desc'], 
        'search' => [ 'except' => '']
    ];

    protected $listeners = ['render', 'delete']; //['render' => 'render'];

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
        'image' => 'nullable|image|max:2048'
    ];

    public function mount()
    {
        $this->post = new Post();
        $this->identificador = rand();
    }

    public function updatingSearch()
    {
        $this->resetPage();
        
    }

    public function render()
    {
        if( $this->readyToLoad ){
            $posts = Post::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        }else{
            $posts = [];
        }

        return view('livewire.show-posts', compact('posts'));
    }

    public function loadPost()
    {
        $this->readyToLoad = true;
    }

    public function order($sort)
    {
        if( $this->sort == $sort ){
            
            if( $this->direction == 'desc' ){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
        }
        
    }

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();

        if($this->image){
            Storage::delete( [ $this->post->image ] );

            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();

        $this->emit('alert', 'El post se actualizó sastifactoriamente');
        
    }

    public function delete(Post $post)
    {
        $post->delete();
    }
}
