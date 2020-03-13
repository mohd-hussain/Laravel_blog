@extends('layouts.app');

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route ('posts.update',$post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$post->title}}" class="form-control" placeholder="Title">
            </div>
    
            <div class="form-group">
                    <label for="body">Body Text</label>
                    <input type="text" name="body"  value="{{$post->body}}" class="form-control" placeholder="Body">
                </div>
    
                <button type="submit" class="btn btn-primary">Submit</button>
                
        </form>
    @endsection