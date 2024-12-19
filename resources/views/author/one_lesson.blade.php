@extends('author.header')

@section('title', $lesson->title)
@section('content')
<div class="df fdr_c g3">
    <div class="df fdr_c g1_5">
        <span class="fsz_1_5 c_dp">Курс: {{$lesson->course}}</span>
        <span class="fsz_1 c_dp">Урок: {{$lesson->title}}</span>
    </div>
    <div class="w78 h2 bg_beige">
        @foreach ($content as $key=>$val)
            {{--var_dump($key)--}}
            {{--var_dump($val)--}}
            @foreach ($val as $k=>$v)
                @if($k == 'img')
                    <img class="w10" src="{{asset("img/lessons/".$v)}}" alt="image_course">
                    {{dump($v)}}
                
                @elseif($k=='txt')
                    <div>{{$v}}</div>
                @endif
                {{--var_dump($k)--}}
                <br>
            @endforeach
        @endforeach
        
    </div>
</div>

@endsection