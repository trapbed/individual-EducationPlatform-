@extends('author.header')

@section('title', "Создание урока  к курсу :'".$course->title."'")
@section('content')
    <span class="ff_mr fsz_2">Создание урока к курсу : '{{$course->title}}'</span>
    <span class="ff_mr fsz_1">Уже есть: {{$course->lesson_count}}</span>
    <div class="pos_f b_2 w72 brc_lp w84 paa_0_5 br_03">
        <form class="df fdr_r g1" enctype="multipart/form-data">
            <div onclick="remove_disabled(event)" class="df ali_c jc_c btn_dp_lp ff_mr fsz_1 w2_5 h2_5 ou_n br_03">+</div>
            <button id="text" class=" ff_mr fsz_1 paa_0_5 ou_n br_03" disabled>Текст</button>
            <button id="img" class=" ff_mr fsz_1 paa_0_5 ou_n br_03" disabled>Изображение</button>
            <input id="img" class=" ff_mr fsz_1 paa_0_5 ou_n br_03" type="file" style="display:none">
        </form>
    </div>

    <form id="preview"  class="df fdr_c g1" action="" method="POST">

        
    </form>
    <input form="preview" class="btn_dp_lp br_03 paa_0_5 ou_n w_au ff_mr fsz_1" id="" type="submit" value="Создать" disabled>

    <script>
        

        function remove_disabled(event){
            alert('1234');
            event.preventDefault();
            if($("#text").attr('disabled') == undefined){
                $('#text').attr('disabled', true);
                $('#img').attr('disabled', true);

                $('#text').removeAttr('onclick');
                $('#img').removeAttr('onclick');
            }
            else{
                $('#text').removeAttr('disabled');
                $('#img').removeAttr('disabled');

                $('#text').attr('onclick', 'add_text(event)');
                $('#img').attr('onclick', 'add_image(event)');

            }
        }

        function add_text(event){
            alert($("#minus_elem").length);
            event.preventDefault();
            let preview = $("#preview");
            let new_text = document.createElement(`div`);
            new_text.classList.add('pos_r', 'w50');
            new_text.innerHTML = `<textarea class='input_create'></textarea><div id="minus_elem" class='pos_a b_3 rm_5 fsz_2 paa_1 bg_dp br_03 c_lp minus_elem'>-</div>`;
            new_text.setAttribute('data-id', $("#minus_elem").length);
            preview.append(new_text);
            // alert('123');
            // $("#minus_elem").attr('onclick', `delete_item(this)`);
            // $(this).attr('data-id', $("#minus_elem").length);

        }
        function add_image(event){
            event.preventDefault();
            // alert('456');
        }

        $(".minus_elem").on("click",function(){
            console.log($(this));
        })
        
    </script>
@endsection