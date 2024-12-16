@extends('header')

@section('title', $title)
@section('content')

    <?php
        $image = 'img/courses/';
        if($course->image){
            $image.=$course->image;
        }
        else{
            $image.= 'default.png';
        }
    ?>

    <div class=" w74 h4"></div>
    <div class="w74 df fdr_r jc_spb ">
        <div class="df fdr_c  g1_5">
            <h2 class="fsz_2_3 ff_ml c_dp">{{$course->title}}</h2>
            <span class="paa_0_5 bg_dp w_a br_03 ff_mr c_w fsz_0_8">{{$course->category}}</span>
            <span class="fsz_1 ff_mr c_dp">{{$course->description}}</span>
            <span class="fsz_1 ff_mr c_dp">Учащихся: {{$course->student_count}}</span>
            <a class="ff_mr btn_purple w8_5 td_n brc_lp" href="">Начать изучать</a>
        </div>
        <div class="w18">
            <img class="paa_1 w18" src="{{asset($image)}}" alt="">
        </div>
    </div>
    
@endsection