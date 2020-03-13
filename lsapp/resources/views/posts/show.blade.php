@extends('layouts.app');

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}
    </div>
    <hr>
<small>Written on {{$post->created_at}} by {{$post->user['name']}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user->id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            <form action="{{ route ('posts.destroy',$post->id) }}" method="POST" class="pull-right">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif
    @endif
@endsection