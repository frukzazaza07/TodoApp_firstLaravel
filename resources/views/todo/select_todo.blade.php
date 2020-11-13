@extends('layouts.app')
<style>
    .check_todo{
        color: red;
        font-weight: bold;
        opacity: 0.7;
        cursor: pointer;
    }
    h2:hover{
        opacity: 1;
    }
    .h2-active{
        color: green;
        font-weight: bold;
        opacity: 1;
    }
    .h2-wait{
        cursor: pointer;
        color: red;
        font-weight: bold;
        opacity: 1;
    }
</style>
@section('content')
    <div class="container-fluid ml-5 mt-4">
         @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
        <div class="card">
            <div class="card-header text-success">
                <h4>Complete todo</h4>
            </div>
        {{-- X = &#10006; 
            ติ๊กถูก = &#10004;
            --}}
        <div class="card-body">
            {{-- {{dd($complete_data ?? '')}} --}}
            @if(count($complete_data) == 0)
                <div style="border-bottom: 1px solid #C8C8C8; margin-bottom: 10px">
                    <h3 class="ml-2 text-center">No complete todo.</h3>
                </div>
            @else
            @foreach ($complete_data ?? '' as $rows)
             {{$rows->updated_at}}
                <div style="border-bottom: 1px solid #C8C8C8; margin-bottom: 10px;">
                    <div class="main" style="display:flex;justify-content:space-between; align-items: center; ">
                        <div>
                            <h2 class="h2-active"style="display: inline-block;">&#10004;</h2> 
                            <h5 class="ml-2"style="display: inline-block;">{{$rows->todo_topic}}</h5>
                        </div>
                        <div class="mr-2">
                            <a href="javascript:void(0)" class="open-sub-main mr-1"><i class="fas fa-plus text-primary plus"></i></a> 
                            <a class="text-danger" href="javascript:void(0)" onclick="onDelete_todo('/todo/delete/{{$rows->id}}/{{$rows->todo_topic}}','{{$rows->todo_topic}}');">ลบ</a>
                        </div>
                    </div>
                    <div class="sub-main-detail" style="display: none;">
                        <span class="text-muted ml-4" style="font-size: 16px">{{$rows->todo_detail}}</span>
                    </div>
                </div>
            @endforeach
            @endif
            
        </div>
        </div>

        <div class="card mt-4">
            <div class="card-header text-danger">
                <h4>Uncomplete todo</h4>
            </div>
        {{-- X = &#10006; 
            ติ๊กถูก = &#10004;
            --}}
        <div class="card-body">
            {{-- {{dd($data ?? '')}} --}}
            @if(count($unComplete_data) == 0)
                <div style="border-bottom: 1px solid #C8C8C8; margin-bottom: 10px">
                    <h3 class="ml-2 text-center">No uncomplete todo.</h3>
                </div>
            @else
            @foreach ($unComplete_data ?? '' as $rows)
             {{$rows->created_at}}
                 <div style="border-bottom: 1px solid #C8C8C8; margin-bottom: 10px;">
                    <div class="main" style="display:flex;justify-content:space-between; align-items: center; ">
                        <div>
                            <h2 class="h2-wait"style="display: inline-block;" onclick="onComplete_todo('/todo/complete/{{$rows->id}}/{{$rows->todo_topic}}','{{$rows->todo_topic}}')">&#10006;</h2> <h5 class="ml-2"style="display: inline-block;">{{$rows->todo_topic}}</h5>
                        </div>
                        <div class="mr-2">
                            <a href="javascript:void(0)" class="open-sub-main mr-1"><i class="fas fa-plus text-primary plus"></i></a> 
                            <a class="text-danger" href="javascript:void(0)" onclick="onDelete_todo('/todo/delete/{{$rows->id}}/{{$rows->todo_topic}}','{{$rows->todo_topic}}');">ลบ</a>
                        </div>
                    </div>
                    <div class="sub-main-detail" style="display: none;">
                        <span class="text-muted ml-4" style="font-size: 16px">{{$rows->todo_detail}}</span>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        </div>
    </div>
@endsection
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
            let message_notification = {
       msg: "You have new todo.",
       title: ""
   }
   let notify = new Notification("new_todo",{
       body: message_notification.msg,
       tag: "NEVERGRIND-CHAT-ALERT"
   });
   notify.onclick = function(){
       location.href = 'www.google.com';
   }
    $(document).ready(function(){

     $('.open-sub-main').click(function(){

        let parent3 = $(this).parent();
        let parent2 = $(parent3).parent();
        let parent1 = $(parent2).parent();
        let submain = $(parent1).find('.sub-main-detail');
        // $(submain).slideUp();
        if ($(submain).is(':visible')) {
            console.log('up');
            $(submain).slideUp('fast')
            $(this).find('.plus').removeClass('fa-minus');
            $(this).find('.plus').addClass('fa-plus');
        } else {
            console.log('down');
            $(submain).slideDown()
            $(this).find('.plus').removeClass('fa-plus');
            $(this).find('.plus').addClass('fa-minus');
        }
    //     $('.sub-main-detail').not($(submain)).slideUp()
    // }).trigger('click');
    });
    });
  function onComplete_todo(url,topic_todo){
        var update_topic = $(this).data('name');
        swal({
            title:`You todo this topic ${topic_todo} complete?`,
            text:'You really have to do it.',
            icon:'warning',
            buttons:true,
            dangerMode:true
        }).then((isComplete)=>{
            if(isComplete){
              $(this).text('\u2713');
              $(this).addClass('h2-active');
              window.location.assign(url);
            }
        });
    }

    function onDelete_todo(url,topic_todo){
        swal({
            title:`You want to delete this topic ${topic_todo}?`,
            text:'If delete you can\'t bring it back.',
            icon:'warning',
            buttons:true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
              window.location.assign(url);
            }
        });
    }
   
</script>
