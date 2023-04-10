<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Auth\CheckLoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UserEmailRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Notifications\RegisterSMS;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController
{
    public function login(UserLoginRequest $request)
    {
        if ($request->type_register === 'phone') {
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return response(['message' => __('auth.login', ['login' => $request->phone])], 404);
            }
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response(['message' => __('auth.login', ['login' => $request->email])], 404);
            }
        }
        if (!Hash::check($request->password, $user->password)) {
            return response(['message' => __('validation.password')], 404);
        }
        return [
            'user' => new UserResource($user),
            'token' => $user->createToken('my-app-token')->plainTextToken
        ];
    }

    public function register(UserRegisterRequest $request)
    {
        if (!$request->phone && !$request->email) {
            return response(['message' => __('auth.empty')], 404);
        }
        if ($request->type_register === 'phone') {
            $sendingPassword = session($request->phone);
        } else {
            $sendingPassword = session($this->getStringEmail($request->email));
        }
        if ($sendingPassword !== $request->password) {
            return response(['message' => __('auth.empty')], 404);
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type_register' => $request->type_register
        ]);
        return new UserResource($user);
    }

    public function checkLogin(CheckLoginRequest $request): array
    {
        if ($request->type_register === 'phone') {
            $user = User::where('phone', $request->phone)->first();
        } else {
            $user = User::where('email', $request->email)->first();
        }
        if ($user) {
            return ['login'=> true];
        }
        return ['login'=> false];
    }

    public function sendPassword(UserEmailRequest $request): array
    {
        $data = [
            'type_register' => $request->type_register,
            'password' => Str::random(8),
        ];
        if ($request->type_register === 'phone') {
            $data['login'] = $request->phone;
            Session::put($request->phone, $data['password']);
            $SMS = new RegisterSMS($data['login'], $data['password']);
            $SMS->sendSMS();
        } else {
            $data['login'] = $request->email;
            session()->put([$this->getStringEmail($request->email) => $data['password']]);
            Mail::to($request->email)->send(new RegisterMail($data['password']));
        }
        return $data;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $newPassword = Str::random(8);
        if ($request->type_register === 'phone') {
            $SMS = new RegisterSMS($request->phone, $newPassword);
            $SMS->sendSMS();
            $user = User::where('phone', $request->phone)->first();
        } else {
            Mail::to($request->email)->send(new RegisterMail($newPassword));
            $user = User::where('email', $request->email)->first();
        }
        $user->password = Hash::make($newPassword);
        $user->save();

        return response(['message' => __('auth.editPasswordSuccess')], 200);
    }

    protected function getStringEmail($email): string
    {
        $explodeDog = explode('@', $email);
        $explodePoint = explode('.', $explodeDog[1]);
        return $explodeDog[0] . $explodePoint[0] . $explodePoint[1];
    }
}
