<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;

use App\Models\UserApplication;

class UserController extends Controller
{
    //
    public function all_users_admin(){
        $all_users = User::select('id','name','email','role','password', 'blocked')->get();
        return view('admin/main', ['users'=>$all_users]);
    }

    public function change_blocked($id_user, $blocked){
        // dd($id_user, $blocked);
        $blocked = User::where('id', '=', $id_user)->update(['blocked'=>$blocked]);
        $all_users = User::select('id','name','email','role','password', 'blocked')->get();
        if($blocked){
            return back()->with(['mess'=>'Доступ изменен!', 'users'=>$all_users]);
        }
        else{
            return back()->with(['mess'=>'Не удалось изменить доступ!', 'users'=>$all_users]);
        }
    }

    public function users_appl(){
        $users_appl = UserApplication::select('user_applications.id','users.name', 'users.id as user_id','current_status','date', 'status_appl','wish_status')->join('users','users.id', '=', 'user_applications.user_id')->orderBy('date')->get();
        return view('admin/users_appl', ['users'=>$users_appl]);
    }
// 'id_user'=>$user->user_id, 'id_appl'=>$user->id, 'role'=>$user->wish_status, 'status_appl'=>'Принята'
    public function change_role($id_user, $id_appl, $role, $status_appl){
        // dd($id_user, $id_appl, $role, $status_appl);
        if($status_appl == 'Принята'){
            $update_role = User::where('id','=',$id_user)->update(['role'=>$role]);
            if($update_role){
                $update_user_appl = UserApplication::where('id','=', $id_appl)->update(['status_appl'=>$status_appl]);
                return back()->with(['mess'=>'Успешное изменение роли!']);
            }
            else{
                return back()->with(['mess'=>'Не удалось изменить роль']);
            }
        }else{
            $update_user_appl = UserApplication::where('id','=', $id_appl)->update(['status_appl'=>$status_appl]);
            return back()->with(['mess'=>'Успешная отмена заявки!']);
        }
    }
}
