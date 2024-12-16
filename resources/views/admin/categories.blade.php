@extends('admin/header')

@section('title','Категории')
@section('content')

<?php
    // dd($categories);
?>
<div class="pos_a bg_lp_a40 t_0 w100 h100 r_1_5 df ali_c jc_c" id="background_modal">
  <div class="df fdr_c ali_c bg_w paa_2 pb_1 pos_r br_1">
      <img onclick="close_modal()" class="pos_a t_0_5 r_0_5 w2_5" src="{{asset('img/close.png')}}" alt="close">
      <span class="fsz_1 c_dp">Создание категории курса</span>
      <form class="df fdr_c g1 ali_e paa_2" action="{{route('create_category')}}" method="POST">
        @csrf
        <input class="w16 h1_5 paa_0_5 fsz_0_8 br_03 ou_n brc_lp" name="title" type="text">


        <input class="paa_0_3 br_03 c_w fsz_1 bg_dp ou_n" type="submit" value="Создать">
      </form>
  </div>
</div>

<div class="w2 h2 bg_lp df ali_c jc_c fsz_1_5 br_03 c_dp" onclick="see_modal()">
    +
</div>

@if (count($categories)>0)
    <div class="w100 h1"></div>
    <table class="table ">
        <thead>
            <tr class="fsz_1">
                <td>Название</td>
                <td>Наличие</td>
                <td>Действия</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <?php
                  // dd($category);
            ?>
            <?php
                // $status = $user->blocked == '1' ? 'Заблокирован' : 'Разблокирован';
                // $action = $user->blocked == '1' ? 'Разблокировать' : 'Заблокировать';
                // $color_btn = $user->blocked == '1' ? 'bg_lg' : 'bg_lr';
                // $bg_color_btn = $user->blocked == '1' ? 'c_dg' : 'c_dr';
                // $to = $user->blocked == '1' ? '0' : '1';
                // $arr_role = ['admin', 'student'];

                $color_btn = $category->exist == '1' ? 'bg_lr' : 'bg_lg';
                $bg_color_btn = $category->exist == '1' ? 'c_dr' : 'c_dg';

                $exist = $category->exist == '1' ? 'Существует' : 'Не существует';
                $action = $category->exist == '1' ? '0' : '1';
                $title = $category->exist == '1' ? 'Скрыть' : 'Показывать';
            ?>
                <tr class=" fsz_1 h3 f_w300 ff_mr">
                    <td>{{$category->title}}</td>
                    <td>{{$exist}}</td>
                    <td><a class="fsz_0_8 br_03 ff_mr  td_n paa_0_3 {{$color_btn}} {{$bg_color_btn}}" href="{{route('change_exist_category', ['exist'=>$action, 'id'=>$category->id])}}">{{$title}}</a></td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
@else
    
    <div class="fsz_1">Пока нет ни одного курса.</div>
    
@endif


<script>
  function close_modal(){
    $("#background_modal").css('display', 'none');
  }
  function see_modal(){
    $("#background_modal").css('display', 'flex');
  }
</script>
@endsection
