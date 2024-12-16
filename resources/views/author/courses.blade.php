@extends('author/header')

@section('title','Мои курсы')
@section('content')
    <div class="pb_1 df fdr_r ali_c jc_spb g2  br_1 bg_w w87_5 pos_f mtm_1">
        <div class="df fdr_r g4 ali_c">
            <h4 class="fsz_1_5 ff_ml c_dp w10">Мои курсы</h4>
            <div class="df ali_c jc_c br_03 w2_5 h2_5 btn_dp_lp w_a ff_m fsz_2 ">+</div>
        </div>
        
        <form action="{{route('main_author')}}" method="GET" class="df fdr_r ali_c jc_spa g2">
            <input value="{{$old_search}}" type="text" name="search" class="w20 fsz_1 ff_mr ou_n paa_0_5 h1 brc_lp br_1 bg_w br_1" placeholder="Поиск">
            <select name="category" class=" ff_mr fsz_1 c_dp w12 paa_0_5 h1 brc_lp bg_w br_1 ou_n">
                <option value="">Категория</option>
                @foreach ($categories as $category)
                    <option {{$category->id == $old_cat ? "selected" : ""}} value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            <select name="order" class="fsz_1 ff_mr c_dp w15 h1 paa_0_5 brc_lp bg_w br_1">
                <option {{$old_order == "access DESC" ? "selected" : ""}} value="access DESC">Сначала популярные</option>
                <option {{$old_order == "courses.created_at DESC" ? "selected" : ""}} value="courses.created_at DESC">Сначала новые</option>
                <option {{$old_order == "courses.created_at ASC" ? "selected" : ""}} value="courses.created_at ASC">Сначала старые</option>
                <option {{$old_order == "title ASC" ? "selected" : ""}} value="title ASC">А-Я</option>
                <option {{$old_order == "title DESC" ? "selected" : ""}} value="title DESC">Я-А</option>
            </select>
            <input class="ff_m fsz_1 c_dp w7 h1 paa_0_5 brc_lp  br_1 search_course" type="submit" value="Искать">
        </form>

    </div>
    <div class="df fdr_c w80 mt_4 g2 bg_w">
        @if($count_courses > 0)
        <table class="table w87_5 ">
            <thead class="w87">
                <tr class="fsz_1 pos_f bg_w ff_m w87 mtm_1_7 h2_2">
                    <td class="w25">Название</td>
                    <td class="w10 ">Категория</td>
                    <td class="w9">Описание</td>
                    <td class="w7 ">Студенты</td>
                    <td class="w12">Дата создания</td>
                    <td class="w4 ">Тест</td>
                    <td class="w5">Доступ</td>
                    <td class="w14 ">Действия</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr class="fsz_1 ff_mr h3 w87">
                    <td class="w25">{{$course->title}}</td>
                    <td class="w10">{{$course->category}}</td>
                    <td class="w9">Подробнее</td>
                    <td class="w7">{{$course->student_count}}</td>
                    <td class="w12">{{$course->created_at}}</td>
                    <?php
                        $test = $course->test != null ? "&#10003;" : "";
                        $access = $course->access == '1' ? "&#10003;" : "";
                        $act1 = $course->access == "1" ? `Показать` : `Скрыть`;
                    ?>
                    <td class="w4">{{html_entity_decode($test)}}</td>
                    <td class="w5">{{html_entity_decode($access)}}</td>
                    <td class="w14"><a class="ff_m fsz_0_8 c_dp w7  paa_0_5 brc_lp  br_1 search_course td_n" href="{{route('update_course', $course->id)}}">Редактировать</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <span class="fsz_1_2 ff_mr c_dp">Нет курсов</span>
        @endif
    </div>
@endsection