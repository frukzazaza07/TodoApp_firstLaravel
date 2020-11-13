@extends('layouts.app')
@section('content')
<div class="container-fluid ml-5 mt-4">
    <h3>Create your todo</h3>
    <hr>
    <div class="row">
        <div class="col-12">
                 @if($errors->all())
     <ul class="alert alert-danger">
         @foreach($errors->all() as $error)
            <li>
                {{-- เป็นการเช็ค error จากการป้อน input --}}
                {{$error}}
            </li>
         @endforeach
     </ul>
     @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
           {!! Form::open(['action' => 'App\Http\Controllers\TodoController@store','method'=>'POST']) !!} 
                <div class="form-group">
                    {!! Form::label('Todo topic')!!}
                    {!! Form::text('todo_topic',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('Todo Detail')!!}
                    {!! Form::textarea('todo_detail',null,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('Todo Places')!!}
                    {!! Form::text('todo_place',null,['class'=>'form-control'])!!}
                </div>
                 <div class="form-group">
                    {!! Form::label('Todo alert date')!!}
                    {!! Form::date('todo_date',date('Y-m-d'),['class'=>'form-control'])!!}
                </div>
                <div class="form-check form-check-inline">
                    {!! Form::radio('todo_alert','1',['class'=>'form-check-input'])!!}
                     {!! Form::label('Alert',null,['class'=>'form-check-label pl-1'])!!}
                </div>
                <div class="form-check form-check-inline">
                    {!! Form::radio('todo_alert','0',['class'=>'form-check-input'])!!}
                     {!! Form::label('Not alert',null,['class'=>'form-check-label pl-1'])!!}
                </div>
                <input type="submit" class="btn btn-primary btn-block mt-3" value="Create Your Todo">
                <input type="reset" class="btn btn-danger btn-block mt-3" value="Reset">
    {!! Form::close() !!}
</div>

@endsection
