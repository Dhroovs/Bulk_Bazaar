<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsApprovedVendor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->is_admin) {
                return $next($request);
            }
            if ($user->isApprovedVendor()) {
                return $next($request);
            }
            if ($user->isVendor()) {
                $status = $user->vendorProfile->status;
                if ($status === 'pending') {
                    return redirect('/dashboard')->with('error', 'Your vendor application is currently pending approval.');
                }
                if ($status === 'suspended') {
                    return redirect('/dashboard')->with('error', 'Your vendor account has been suspended.');
                }
                if ($status === 'rejected') {
                    return redirect('/dashboard')->with('error', 'Your vendor application was rejected.');
                }
            }
        }

        return redirect('/vendor/register')->with('error', 'Please apply for a vendor account to access this section.');
    }
}
