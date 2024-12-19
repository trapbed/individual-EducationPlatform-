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
                    dump($key);
                    $value->move(public_path()."/img/lessons", $value->getClientOriginalName());
                    $array_data[$key] = ["img"=>$value->getClientOriginalName()];
                    dump($value->getClientOriginalName());
                }
            }
        }
        ksort($array_data);

        $array_data = json_encode($array_data);

        $create = Lesson::insert([
            'title'=>$title,
            'course_id'=>$id,
            'content'=>$array_data
        ]);
        if($create){
            return redirect('author_more_info_course/'.$id)->withErrors(['success'=>'Урок создан!']);
        }
        else{
            return redirect('author_more_info_course/'.$id)->withErrors(['error'=>'Не удалось создать урок!']);
        }
        
    }
}
