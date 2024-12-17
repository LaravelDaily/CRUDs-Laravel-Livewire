<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public Post $post;

    #[Validate('required|min:5')]
    public string $title = '';

    #[Validate('required|min:5')]
    public string $slug = '';

    #[Validate('required|min:5|max:1000')]
    public string $body = '';

    public function mount(Post $post): void
    {
        $this->post = $post;

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->body = $post->body;
    }

    public function render(): View
    {
        return view('livewire.posts.edit');
    }

    public function save(): void
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
        ]);

        session()->flash('message', 'Post updated successfully');

        $this->redirectRoute('posts.index');
    }
}
