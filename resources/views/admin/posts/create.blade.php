@extends('template')
@section('title', 'New Post')
@section('content')
    <h1>Cadastrar novo Post</h1>

    <form action="{{ route('posts.store') }}" method="post">
        @include('admin.posts._partials.form')
    </form>
@endsection

