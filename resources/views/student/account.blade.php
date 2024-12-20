@extends('header')
@section('title', 'Аккаунт')
@section('content')
    <div class="h4 w94_9"></div>
    <div class="bg_lp w94_9 df frd_r ff_mr fsz_1_2">
        <div class="df fdr_c g2">
            <div class="df fdr_r g1">
                <span class="w18">Имя</span>
                <span>{{Auth::user()->name}}</span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Почта</span>
                <span>{{Auth::user()->email}}</span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Зарегистрирован с:</span>
                <span>{{date("d-m-Y",(strtotime(Auth::user()->created_at)-strtotime(date('Y-m-d H:i:s'))))}}</span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Начато уроков</span>
                <span></span>
            </div>
            <div class="df fdr_r g1">
                <span class="w18">Завершено</span>
                <span></span>
            </div>
        </div>
    </div>
    {{--floor(strtotime(date('Y-m-d H:i:s'))-strtotime(Auth::user()->created_at))/3600--}}
@endsection