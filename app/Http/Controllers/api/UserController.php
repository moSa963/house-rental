<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function create(Request $request)
    {
       return $request->user();
    }

    public function update(Request $request){
        $user = $request->user();

        if (isset($request->image)){
            Storage::putFileAs('users', $request->image, $user->username);
        }

        return response()->noContent();
    }

    public function image(Request $request, User $user){
        if (Storage::exists('users/'.$user->username)){
            return Storage::download('users/'.$user->username);
        }

        return redirect("/images/user.png");
    }
}
