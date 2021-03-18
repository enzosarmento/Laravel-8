@extends('template')

@section('title', 'Feed')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('posts.index') }}">Laravel8</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
      <form action="{{ route('posts.search') }}" method="post" class="form-inline my-2 my-lg-0">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Pesquisar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
      </form>
    </div>
  </nav>
  <br>
  <a class="btn btn-success" href="{{ route('posts.create') }}">Criar novo Post</a>
  <hr>
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>

@endif
        <h1>Posts</h1>

        @foreach($posts as $post)




            <h3>{{ $post->title }}</h3>
            <img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}" style="max-width: 400px">
            <p>
                {{ $post->content }}
            </p>
            <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">Ver</a>
            <a class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}">Edit</a>
            <br>
            <br>

        @endforeach

<hr>
@if (isset($filters))
    {{ $posts->appends($filters)->links() }}
@else
    {{ $posts->links() }}

@endif

@endsection
