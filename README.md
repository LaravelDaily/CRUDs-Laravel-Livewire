# Laravel CRUD: Breeze + Livewire and Alpine.js Version

This project is a simple Laravel CRUD for Posts model built on top of Laravel Breeze starter kit, adding Livewire + Alpine functionality.

![](https://laraveldaily.com/uploads/2024/12/crud-livewire-post-form.png)

---

## Installation

Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/LaravelDaily/CRUDs-Laravel-Livewire project
   cd project
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install && npm run build
   ```

3. Copy the `.env` file and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Set up the database:
    - Update `.env` with your database credentials.
    - Run migrations and seed the database, repo includes fake posts:
      ```bash
      php artisan migrate --seed
      ```

6. If you use Laravel Herd/Valet, access the application at `http://project.test`.

7. Log in with credentials: `test@example.com` and `password`.

---

## Features to Pay Attention To

This project goes beyond the default Laravel Breeze setup with the following enhancements.

1. Uses Laravel Breeze but not its official Livewire Volt version. Instead, the project uses Blade version of Breeze, adding Livewire only for create/edit forms with dynamic elements.
2. Also, the project doesn't use Livewire full-page components, it uses Laravel `PostController` and the full layout comes from Laravel Breeze starter kit
3. Creates two Livewire components: `Posts/Create` and `Posts/Edit`
4. Adds `slug` input field with auto-generating the slug as the post title is being typed, with 1-second delay: `wire:model.live.debounce.1s`
5. Utilizes PHP Attribute `#Validate` to define the validation rules for the fields
6. Uses Alpine.js to show the number of characters remained in the post body in "live" mode: `<span x-text="body ? body.length : 0">`
7. Uses "flash" messages in the session to show the result after store/update/delete: `session()->flash('message', 'Post updated successfully');`
8. Includes Pest test file `PostsTest` that has methods to test all Livewire form elements and also validation of each field.

![](https://laraveldaily.com/uploads/2024/12/crud-livewire-posts-tests.png)

---

## Found a bug? Got a question/idea?

Raise a GitHub issue or email `info@laraveldaily.com`. 
