@extends('template')

@section('content')
<h1>Detalhes do post {{ $post->title }}</h1>

<ul>
    <li><strong>Título: </strong>{{ $post->title }}</li>
    <li><img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}" style="max-width: 200px"></li>
    <li><strong>Conteúdo: </strong>{{ $post->content }}</li>
</ul>

<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">
    <button class="btn btn-danger" type="submit">Deletar o Post {{ $post->title }}</button>
</form>

@endsection
