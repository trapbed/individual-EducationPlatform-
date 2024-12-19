<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //
    public function create_lesson(Request $request){

        $array_data = [];
        $id = $request->id_course;
        $texts = $request->request;
        $imgs = $request->files;
        $title = $request->title;
        foreach($texts as $text){
            if(gettype($text) == 'array'){
                foreach($text as $key=>$value){
                    $array_data[$key] =["txt"=> $value];
                }
            }            
        }

        foreach($imgs as $img){
            if(gettype($img) == 'array'){
                foreach($img as $key=>$value){
                    $value->move(public_path()."/img/lessons", $value->getClientOriginalName());
                    $array_data[$key] = ["img"=>$value->getClientOriginalName()];
                }
            }
        }
        ksort($array_data);
        $array_data = json_encode($array_data);
        $create = Lesson::insert([
            'title'=>$title,
            'course_id'=>$id,
            'content'=>($array_data)
        ]);
        if($create){
            return redirect('author_more_info_course/'.$id)->withErrors(['success'=>'Урок создан!']);
        }
        else{
            return redirect('author_more_info_course/'.$id)->withErrors(['error'=>'Не удалось создать урок!']);
        }
        
    }

    public function one_lesson($id){
        $one_lesson = Lesson::select('lessons.id', 'lessons.title', 'courses.title as course', 'content')->join('courses', 'courses.id', '=', 'lessons.course_id')->where('lessons.id', '=', $id)->get()[0];
        $content = array( json_decode(($one_lesson->content)));
        $array_content = [];
        foreach($content as $key=>$value){
            foreach($value as $a=>$b){
                dump($a);
                $array_content[$a] =get_object_vars($b);
            }
        }
        dump($array_content);
        // dd($content);
        // dd($one_lesson);
// @extends('author.header')resources/views/author/one_lesson.blade.php
        return view('author/one_lesson',  ['lesson'=>$one_lesson, 'content'=>$array_content]);
    }
}
