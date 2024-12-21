@extends('author.header')
@section('title', 'Аккаунт')
@section('content')
    <div class="h4 w94_9"></div>
    <div class="df frd_r als_c g12 ff_mr fsz_1_2">
        <div class="df fdr_c g2 brc_lp paa_1 br_03">
            <div class="df fdr_r g1">
                <span class="w18">Имя</span>
                <span>{{Auth::user()->name}}</span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Почта</span>
                <span>{{Auth::user()->email}}</span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Текущая роль</span>
                <span>{{Auth::user()->role}}</span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Зарегистрирован с:</span>
                <span>{{date("d-m-Y",(strtotime(Auth::user()->created_at)))}}</span>
            </div>
        </div>
        <form class="df fdr_c g1 brc_lp paa_1 br_03" action="{{route('edit_account')}}" method="POST">
            @csrf
            <span class="fsz_1_5 ptb_0_5">Редактирование</span>
            <div class="df fdr_c g0_5 ff_mr fsz_1_2">
                <label for="name">Имя</label>
                <input name="name" class="ou_n paa_0_5 brc_lp br_03 w23 ff_mr fsz_1" type="text" value="{{Auth::user()->name}}">
            </div>
            <div class="df fdr_c g1 ff_mr fsz_1_2">
                <label for="email">Почта</label>
                <input name="email" class="ou_n paa_0_5 brc_lp br_03 w23 ff_mr fsz_1" type="text" value="{{Auth::user()->email}}">
            </div>
            <input class="btn_dp_lp w_au paa_0_5 ou_n br_03 ff_mr fsz_1_2" type="submit" value="Сохранить">
        </form>
    </div>
    {{--floor(strtotime(date('Y-m-d H:i:s'))-strtotime(Auth::user()->created_at))/3600--}}
@endsection