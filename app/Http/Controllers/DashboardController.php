<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_admin > 0) {
            $users = User::orderBy('is_enabled', 'DESC')->orderBy('name', 'ASC')->get();
            $permitsAllowed[] = 'is_admin';
        } else {
            $user = Auth::user();
            $allowedPermissions = $user->permissions->pluck('name');

            $users = User::where('id', Auth::user()->id)->get();
        }

        return view('dashboard', compact('users', 'permitsAllowed'));
    }

    public function noallowed()
    {
        return view('noallowed');
    }
}
