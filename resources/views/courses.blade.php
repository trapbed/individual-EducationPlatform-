@extends('header')

@section('title', 'Курсы')
@section('content')
<?php
    
?>
<div class="w100 h1"></div>
<div class="df fdr_r ali_c jc_spa g2 paa_1 br_1 bg_lp_a40">
    <form action="{{route('courses')}}" method="GET" class="df fdr_r ali_c jc_spa g2">
        <input value="{{$old_search}}" type="text" name="search" class="w26 fsz_1 ff_mr ou_n paa_1 h1 brc_lp br_1 bg_w br_1" placeholder="Поиск">
        <select name="category" class=" ff_mr fsz_1 c_dp w15 paa_1 h1 brc_lp bg_w br_1 ou_n">
            <option value="">Категория</option>
            @foreach ($categories as $category)
                <option {{$category->id == $old_cat ? "selected" : ""}} value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <select name="order" class="fsz_1 ff_mr c_dp w15 h1 paa_1 brc_lp bg_w br_1">
            <option {{$old_order == "access DESC" ? "selected" : ""}} value="access DESC">Сначала популярные</option>
            <option {{$old_order == "courses.created_at DESC" ? "selected" : ""}} value="courses.created_at DESC">Сначала новые</option>
            <option {{$old_order == "courses.created_at ASC" ? "selected" : ""}} value="courses.created_at ASC">Сначала старые</option>
            <option {{$old_order == "title ASC" ? "selected" : ""}} value="title ASC">А-Я</option>
            <option {{$old_order == "title DESC" ? "selected" : ""}} value="title DESC">Я-А</option>
        </select>
        <input class="ff_m fsz_1 c_dp w7 h1 paa_1 brc_lp  br_1 search_course" type="submit" value="Искать">
    </form>
</div>
<div class="w100 h10"></div>
@endsection