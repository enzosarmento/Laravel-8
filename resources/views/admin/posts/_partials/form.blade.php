@if($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </div>
@endif

<input type="hidden" value="{{ csrf_token() }}" name="_token">
<div class="form-group">
    <input class="form-control" type="text" name="title" id="title" placeholder="Título" value="{{ $post->title ?? old('title')}}">
</div>
<div class="form-group">
    <textarea class="form-control" name="content" id="content" cols="30" rows="4" placeholder="Conteúdo">{{ $post->content ?? old('content')}}</textarea>
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" id="image">
</div>
<button class="btn btn-primary" type="submit">Enviar</button>
