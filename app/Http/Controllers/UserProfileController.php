<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function userProfile() : View
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "User Profile Page"],
        ];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $user = Auth::user();
        $users = User::all();
        return view('pages.user-profile-page', [
        'pageConfigs' => $pageConfigs,
        'user' => $user,
        'users' => $users,
        'breadcrumbs' => $breadcrumbs]);
    }
}
