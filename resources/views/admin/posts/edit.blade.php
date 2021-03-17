@extends('template')
@section('title', 'Edit Post')
@section('content')
    <h1>Editar o posts <strong>{{ $post->title }}</strong></h1>

    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @method('put')
        @include('admin.posts._partials.form')

    </form>
@endsection

