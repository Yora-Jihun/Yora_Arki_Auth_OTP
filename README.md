# Yora Jihun - Local Auth Arki 

A Laravel-based authentication starter built with my own architecture, designed for developers who want to start local and scale their own application.

## Built With

- **Laravel** 13 — backend framework
- **Livewire** 4 — reactive frontend without leaving PHP
- **Tailwind CSS** — utility-first styling

## Getting Started

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run `php artisan migrate --force`
5. Run `php artisan key:generate`
6. Run `npm install && npm run build`
7. Serve with `php artisan serve`

## Features

- Register & Login with remember me
- One-Time Password (OTP) verification for registration, password reset, and account deletion
- Dashboard with sidebar navigation
- Profile Settings (name, email, avatar)
- Security Settings (change password, delete account)
- Responsive layout with collapsible sidebar

## Architecture

I used my own architecture to build this — clean separation of concerns with service classes, formatters, and Livewire components. Start local, deploy later.

made by ji-hun
