<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index() {
        return view("projects.profile");
    }

    public function update () {
        $userId=auth()->id();
        $data = request()->validate([
            "name" => "required|min:3",
            "email" => "required|email",
            "password" => "nullable|confirmed|min:8",
            "image" => "mimes:jpeg,jpg,png"
        ]);

        if (request()->has("password")) {
            $data["password"] = Hash::make(request("password"));
        }

        if (request()->hasFile("image")) {
            $path= request("image")->store("public/users");
            $data["image"]= $path;

        }

        User::findOrFail($userId)->update($data);

        return back();
    }
}