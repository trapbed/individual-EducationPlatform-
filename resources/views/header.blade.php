<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->
</head>
<body class="">
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>alert("{{$error}}");</script>
    @endforeach
@endif
<div class="df fdr_c g2 ali_c w98_9vx  pos_r ">
    <nav class="df fdr_r ali_c pos_f w94_9 h4 bg_lp t2 br_rb_0_5 br_lb_0_5 jc_spb plr_1">
        <div class="df fdr_r g3 ali_c">
            <a class="td_n df fdr_r g1 ali_c" href="{{route('main')}}"><img class="w2_5 h2_5" src="{{asset('img/logo.png')}}" alt="LOGO"><span class="fsz_1 ff_m c_dp">Лига знаний</span></a>
            <a class="td_n ff_m c_dp fsz_1" href="{{route('courses')}}">Все курсы</a>
            {{--<a class="td_n ff_m c_dp fsz_1" href="{{route('categories_main')}}">Категории</a>--}}
        </div>
        <div class="df fdr_r g1 ali_c">
            @guest
                <a class="btn_purple td_n ff_m c_dp fsz_1" href="{{route('signup')}}">Зарегистрироваться</a>
                <a class="btn_purple td_n ff_m c_dp fsz_1" href="{{route('login')}}">Войти</a>
            @endguest
            @auth
                <a class="td_n ff_m c_dp fsz_1" href="{{route('student_account')}}">Аккаунт</a>
                <a class="td_n ff_m c_dp fsz_1" href="{{route('logout')}}"><img class="w1_5 h1_5" src="{{asset('img/logout.png')}}" alt=""></a>

            @endauth
        </div>
    </nav>
    <div class="min_h34 mt_1 df fdr_c g1">
    @yield('content')
    </div>
    </div>
    <!-- footer -->
    <div class="df fdr_r ali_c jc_c w98_9vx bg_lp">
        <div class=" df fdr_r jc_spb w72 h8 paa_2 ">
            <div class="df fdr_c g1 w18 ">
                <a class="td_n df fdr_r g1 ali_c h3" href="{{route('main')}}"><img class="w2_5 h2_5" src="{{asset('img/logo.png')}}" alt="LOGO"><span class="fsz_1 ff_m c_dp">Лига знаний</span></a>
                    <a href="" class="df fdr_r ali_c td_n  g1"><img src="{{asset('img/mail.png')}}" alt="" class="w2"><span class="td_n fsz_1 c_dp g1 ff_m">trapbed@mail.ru</span></a>
                    
            {{-- <a href="{{route('main')}}" class="td_n fsz_1 c_dp g1 ff_m">Категории</a>--}}
                
            </div>
            <div class="df fdr_c g1 w18 ">
                <a href="{{route('main')}}" class="td_n fsz_1 c_dp g1 ff_m">Главная</a>
                <a href="{{route('main')}}" class="td_n fsz_1 c_dp g1 ff_m">Все курсы</a>
                <a href="{{route('main')}}" class="td_n fsz_1 c_dp g1 ff_m">Категории</a>
                <a href="{{route('main')}}" class="td_n fsz_1 c_dp g1 ff_m">Контакты</a><!-- Почта(mail, gmail, phone, address, post index)-->
                
            </div>
            <div class="df fdr_c g1 w18 ">
                <span class="fsz_1 c_dp g1 ff_m">Социальные сети</span>
                <div class="w12 df fdr_r g1">
                    <a href="https://t.me/Ioweve" class="td_n img_sh"><img src="{{asset('img/telegram.png')}}" alt="" class="w2"></a>
                    <a href="https://vk.com/trapbed" class="td_n img_sh"><img src="{{asset('img/vk.png')}}" alt="" class="w2"></a>
                    <a href="https://www.figma.com/design/mscDtNunLdbsMpM1C9kxDl/project-manager?node-id=79-1430&m=dev&t=CWGPF7ZAXra0rMlf-1" class="td_n img_sh"><img src="{{asset('img/figma.png')}}" alt="" class="w2"></a>
                </div>
            </div>
            
            
        </div>
    </div>

</body>
</html>