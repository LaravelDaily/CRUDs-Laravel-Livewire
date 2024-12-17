<?php

use App\Models\User;
use App\Models\Post;
use App\Livewire\Posts\Edit;
use App\Livewire\Posts\Create;
use Illuminate\Support\Collection;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('index page displays posts', function (Collection $posts) {
    $response = $this->get(route('posts.index'));

    $response->assertOk();

    $response->assertSeeTextInOrder($posts->pluck('title')->toArray());
})->with([fn () => Post::factory(3)->create()]);

test('create page loads successfully', function () {
    $response = $this->get(route('posts.create'));

    $response
        ->assertOk()
        ->assertSeeLivewire(Create::class);
});

test('store post validates and persists data', function (string $title, string $slug, string $body) {
    livewire(Create::class)
        ->set('title', $title)
        ->set('slug', $slug)
        ->set('body', $body)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('message', __('Post created successfully'));

    $this->assertDatabaseHas('posts', [
        'title' => $title,
        'slug' => $slug,
        'body' => $body,
    ]);
})->with([
    [
        'title' => 'Post Title',
        'slug' => 'post-title',
        'body' => 'Post description',
    ],
]);

test('edit page loads successfully', function () {
    $post = Post::factory()->create();

    $response = $this->get(route('posts.edit', $post));

    $response->assertOk()
        ->assertSeeLivewire(Edit::class)
        ->assertSee($post->title);
});

test('update post validates and persists changes', function (string $title, string $slug, string $body) {
    $post = Post::factory()->create();

    livewire(Edit::class, [$post])
        ->set('title', $title)
        ->set('slug', $slug)
        ->set('body', $body)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('posts.index'))
        ->assertSessionHas('message', __('Post updated successfully'));

    $this->assertDatabaseHas('posts', array_merge(['id' => $post->id], [
        'title' => $title,
        'slug' => $slug,
        'body' => $body,
    ]));
})->with([
    [
        'title' => 'Updated Post Title',
        'slug' => 'updated-post-title',
        'body' => 'Updated Post description',
    ],
]);

test('store posts fails validation', function () {
    livewire(Create::class)
        ->call('save')
        ->assertHasErrors(['title', 'slug', 'body']);
});

test('update posts fails validation', function () {
    $post = Post::factory()->create();

    livewire(Edit::class, [$post])
        ->set('title')
        ->set('slug')
        ->set('body')
        ->call('save')
        ->assertHasErrors(['title', 'slug', 'body']);
});

test('destroy post deletes it from database', function () {
    $post = Post::factory()->create();

    $response = $this->delete(route('posts.destroy', $post));

    $response->assertRedirect(route('posts.index'));
    $response->assertSessionHas('message', __('Post deleted successfully'));

    $this->assertModelMissing($post);
});
