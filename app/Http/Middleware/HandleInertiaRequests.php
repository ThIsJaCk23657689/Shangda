<?php

namespace App\Http\Middleware;

use App\Consumer;
use App\Support\StaffPermissions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /** @return array<string, mixed> */
    public function share(Request $request): array
    {
        /** @var User|null $staff */
        $staff = Auth::guard('web')->user();
        /** @var Consumer|null $consumer */
        $consumer = Auth::guard('consumer')->user();

        return [
            ...parent::share($request),
            'appName' => config('app.name', '上大食品'),
            'auth' => [
                'staff' => $staff ? [
                    'id' => $staff->id,
                    'name' => $staff->name,
                    'email' => $staff->email,
                    'jobTitleId' => $staff->job_title_id,
                    'jobTitle' => $staff->jobTitle?->name,
                ] : null,
                'consumer' => $consumer ? [
                    'id' => $consumer->id,
                    'account' => $consumer->account,
                    'name' => $consumer->name,
                    'email' => $consumer->email,
                    'accountType' => $consumer->account_type,
                ] : null,
            ],
            'permissions' => StaffPermissions::for($staff),
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
                'warning' => fn () => $request->session()->get('warning'),
                'info' => fn () => $request->session()->get('info'),
            ],
        ];
    }
}
