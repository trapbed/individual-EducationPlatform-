<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    //main
    public function main(){
        $newest_course = Course::select('courses.id','categories.title as category', 'courses.title','description')->where('access', '=', '1')->join('categories', 'categories.id', '=', 'courses.category')->orderBy('student_count', 'DESC')->limit(5)->get();
        // dd($newest_course);
        return view('main', ['courses'=>$newest_course]);
    }
// courses
    public function main_courses(){
        $all_access_courses = Course::select('courses.id','categories.title as category','courses.title','description', 'users.name as author', 'student_count', 'test')->where('access','=', '1');

        $all_access_courses = $all_access_courses->join('categories', 'categories.id', '=', 'courses.category')->join('users', 'users.id', '=', 'courses.author')->orderBy('student_count', 'DESC');

        $all_access_courses = $all_access_courses->get();

        return view('courses', ['courses'=> $all_access_courses]);
    }
    public function get_all_admin(){
        $courses = Course::select('courses.id as course_id','courses.title as course_title','categories.title as category_title', 'description', 'users.name as author','access','test', 'courses.created_at')
        ->JOIN('users','users.id','=', 'courses.author')
        ->JOIN('categories','categories.id','=','courses.category')->get();
        // dd(count($courses));
        return view('admin/courses', ['courses'=>$courses]);
    }

    public function change_access_course($access, $id_course){
        // dd($access, $id_course);
        $update = Course::where('id', '=', $id_course)->update(['access'=>$access]);
        $courses = Course::select('courses.id as course_id','courses.title as course_title','categories.title as category_title', 'description', 'users.name as author','access','test', 'courses.created_at')
        ->JOIN('users','users.id','=', 'courses.author')
        ->JOIN('categories','categories.id','=','courses.category')->get();
        if($update){
            return back()->with(['mess'=>'Доступ изменен!', 'courses'=>$courses]);
        }
        else{
            return back()->with(['mess'=>'Не удалось изменить доступ!', 'courses'=>$courses]);
        }
        // return response()->json($request);
    }
}
