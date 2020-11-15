<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\SettingService;

class AllowRegister
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (0 == $this->settingService->getSetting('register')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
