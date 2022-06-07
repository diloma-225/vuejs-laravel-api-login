<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|confirmed|min:4',
            ],
            [
                'name.required'=>'Veuillez remplir ce champs',
                'email.required'=>'Veuillez remplir ce champs',
                'password.required'=>'Veuillez remplir ce champs',
                'password.min'=>'Le mot de passe doit contenir au moins 4 carractères',
                'email.unique'=>'Cette addresse à déjà été utlisé pour un autre compte',
                'password.confirmed'=>'Vos mots de passe ne correspondent pas',
            ]
        );

        $form = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password) ,
        ];

        $user = User::create($form);

        $token = $user->createToken('MY_APP_TOKEN')->plainTextToken;

        return response()->json(['user'=>$user, 'token'=>$token]);
    }

    public function login(Request $request){
        $request->validate(
            [
                'email'=>'required|email',
                'password'=>'required|min:4',
            ],
            [
                'email.required'=>'Veuillez remplir ce champs',
                'email.email'=>'Veuillez saisir une addresse mail valide',
                'password.required'=>'veuillez remplir ce champs',
                'password.min'=>'Le mot de passe doit contenir au moins 4 carractères',
            ]
        );

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = $request->user();

            $token = $user->createToken('MY_APP_TOKEN')->plainTextToken;

            return response()->json(['token'=>$token, 'user'=>$user]);

        }else{
            return response()->json(['authFailed'=>''], 422);
        }
    }

    public function logout(Request $request){
        $user = User::where('id', $request->id)->first();
        $user->tokens()->delete();
    }

    public function update(Request $request){

        $form = [
            'name'=>$request->name,
            'email'=>$request->email
        ];

        $user = User::where('id', $request->id)->first();

        $user->update($form);
    }

    public function updatePassword(Request $request){

        $request->validate(
            [
                'old_password'=>'required|min:4',
                'password'=>'required|confirmed|min:4'
            ],
            [
                'old_password.required'=>'Veuillez remplir ce champs',
                'old_password.min'=>'Votre mot de passe doit contenir au moins 4 carractères',
                'password.required'=>'Veuillez remplir ce champs',
                'password.confirmed'=>'Vos mots de passe ne correspondent pas',
                'password.min'=>'Votre mot de passe doit contenir au moins 4 carractères',
            ]
        );

        $user = PersonalAccessToken::findToken($request->token);

        $user = User::where('id', $user->tokenable_id)->first();

        if (Hash::check($request->old_password, $user->password)) {

            $user->update([
                'password'=>bcrypt($request->password)
            ]);

            return response()->json('true');
        }else{


            return response()->json(['old_password'=>'Votre mot de passe ne correspond à acun compte'], 401);

        }
    }
}
