@extends('layouts.app');

@section('content')
    <h1>Create Post</h1>
    {{-- {!! Form::open(['action' => 'PostsController@store' , 'method' => 'POST']) !!} 
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::text('body','',['class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} --}}

    <form action="{{ route ('posts.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="" class="form-control" placeholder="Title">
        </div>

        <div class="form-group">
                <label for="body">Body Text</label>
                <input type="text" name="body"  value="" class="form-control" placeholder="Body">
            </div>
            <div class="form-group">
                <input type="file" name="cover_image[]">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @csrf
    </form>
@endsection