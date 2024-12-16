<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    //
    public function signup(Request $request){
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'pass'=>$request->pass
        ];
        $rules = [
            'name'=>'required|min:6',
            'email'=>'required|min:6|email|unique:users',
            'pass'=>'required|regex:/^[a-zA-Z0-9_]+$/|min:6'
        ];
        $messages = [
            'name.required'=>'Заполните имя',
            'name.min'=>'Минимальная длина имени- 6 символов',
            'email.required'=>'Заполните почту',
            'email.min'=>'Минимальная длина почты- 6 символов',
            'email.email'=>'Проверьте введенную почту',
            'email.unique'=>'Пользователь с такой почтой существует!',
            'pass.required'=>'Заполните пароль',
            'pass.min'=>'Минимальная длина пароля- 6 символов',
            'pass.regex'=>'Пароль может содержать только латиницу, цифры и символ нижнего подчеркивания'
        ];
        $validate = Validator::make($data, $rules, $messages);
        if($validate->fails()){
            return redirect('signup')
            ->withErrors($validate)
            ->withInput();
        }
        else{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>'student',
                'password'=>Hash::make($request->pass),
            ]);
            Auth::login($user);
            if(Auth::user()->role == 'student'){
                return redirect()->route('main');

            }
            else if(Auth::user()->role == 'author'){
                return redirect()->route('main_author');

            }
            else if(Auth::user()->role == 'admin'){
                return redirect()->route('main_admin');

            }
        }
    }
    public function login_db(Request $request){
        $user_check = User::where('email', '=', $request->email)->exists();
        if($user_check){
            $user = User::select('id', 'email', 'password')->where('email', '=', $request->email)->get()[0];
            $pass = $user->password;
            $id = $user->id;
            if(Hash::check($request->pass, $pass)){
                Auth::login( User::find($id));
                if(Auth::user()->role == 'student'){
                    return redirect()->route('main');
    
                }
                else if(Auth::user()->role == 'author'){
                    return redirect()->route('main_author');
    
                }
                else if(Auth::user()->role == 'admin'){
                    return redirect()->route('main_admin');
    
                }
            }
            else{
                return back()->withErrors([
                    'pass'=>'Неверный пароль'
                ])->withInput();
            }
        }
        else{
            return back()->withErrors([
                'email'=>'Нет такого пользователя'
            ])->withInput();
        }
    }
    public function logout(){
            Auth::logout();
            return redirect()->route('login');
    }

}
