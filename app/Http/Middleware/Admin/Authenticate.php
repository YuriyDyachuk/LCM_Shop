<?php

namespace App\Http\Middleware\Admin;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        if ($request->route()->getName() === 'admin.login')
        {
            return $this->auth->shouldUse('admin');
        }

        if (empty($guards))
        {
            $guards = ['admin', null];
        }

        parent::authenticate($request, $guards);
    }

    protected function redirectTo($request)
    {
        return route('admin.login');
    }
}
