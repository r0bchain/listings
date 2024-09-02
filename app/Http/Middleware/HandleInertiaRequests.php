<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'logo' => fn() => asset('storage/images/logo.png'),
            'flash'=> [
                'success' => fn() => $request->session()->get('success'),
                'error'   => fn() => $request->session()->get('error'),
            ],

            'site' => fn() => [
                'APP_NAME' => env('APP_NAME'),
                'APP_SLOGAN' => env('APP_SLOGAN'),
                'APP_REGISTER_TITLE' => env('APP_REGISTER_TITLE'),
                'RANDOM_IMAGE_VENDOR' => env('RANDOM_IMAGE_VENDOR'),
                'RANDOM_IMAGE_KEY' => env('RANDOM_IMAGE_KEY'),
                'TOPICS_IMAGE' => explode(',', env('TOPICS_IMAGE')),
                'DEFAULT_CATEGORY_IMAGE' => explode(';', env('DEFAULT_CATEGORY_IMAGE'))
            ],

            'user' => fn() => $request->user()
                ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'notificationCount' => $request->user()->unreadNotifications()->count(),
                ]
                // ? $request->user()->only('id', 'name', 'email')
                : null,

            'categories' => fn() => \App\Models\Category::whereNull('parent_id')->get(),
            // 'defaultCategory' => fn() => \App\Models\Category::whereNull('parent_id')->first(),
        ]);
    }
}
