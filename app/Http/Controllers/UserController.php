<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => ["required", "regex:/^([a-zA-Z]|\s)+$/"],
            "username" => ["required", "min:3", "max:16", "unique:users", "regex:/^(\w|-|_|\.){3,16}$/"],
            "email" => ["required", "unique:users", "email:dns"],
            "password" => ["required", "min:5"],
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::create($validatedData);

        return redirect("/login")->with($request->session()->flash("success", "Registration successful! Please login"));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // "username" => ["required", "min:3", "unique:users"],
            "email" => ["required", "email"],
            "password" => ["required", "min:5"],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended("/");
            // return redirect()->intended("/dashboard");
        } else {
            return back()->with("fail", "Login failed");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function update(Request $request)
    {
        $userId = Auth::user()->id;
        $validatedData = $request->validate([
            "name" => ["required", "regex:/^([a-zA-Z]|\s)+$/"],
            "email" => ["required", "unique:users,email,$userId", "email:dns"],
            "username" => ["required", "min:3", "max:16", "unique:users,username,$userId", "regex:/^(\w|-|_|\.){3,16}$/"],
            "phone" => ["nullable", "unique:users,phone,$userId", "regex:/^(\d|\(|\)|-){8,15}$/"],
            "address" => "nullable",
        ]);

        if ($request["password"]) {
            $validatedData["password"] = bcrypt($request["password"]);
        }

        User::find($userId)->update($validatedData);

        return redirect("/dashboard")->with(
            $request->session()->flash("success", "Edit account successfully")
        );
    }
}