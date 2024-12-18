<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|min:5')]
    public string $title = '';

    #[Validate('required|min:5')]
    public string $slug = '';

    #[Validate('required|min:5|max:1000')]
    public string $body = '';

    public function render(): View
    {
        return view('livewire.posts.create');
    }

    public function updatedTitle(): void
    {
        $this->slug = str()->slug($this->title);
    }

    public function save(): void
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
        ]);

        session()->flash('message', 'Post created successfully');

        $this->redirectRoute('posts.index');
    }
}
