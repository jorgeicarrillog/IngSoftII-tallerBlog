@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Editar Post</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('posts.update', $post->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-row justify-content-center">
                            <div class="col-md-10 mb-3">
                              <label for="validationDefault01">Titulo</label>
                              <input type="text" class="form-control" readonly value="{{$post->title}}" required>
                            </div>
                            <div class="col-md-10 mb-3">
                              <label for="validationDefault01">Contenido</label>
                              <textarea class="form-control" name="content" required>{{$post->content}}</textarea>
                            </div>
                            <div class="col-md-5 mb-3">
                              <label for="validationDefault01">Publicado?</label>
                              <select class="form-control" name="posted" required>
                                  <option value="yes" {{($post->posted=='yes')?'selected':''}}>SI</option>
                                  <option value="not" {{($post->posted=='not')?'selected':''}}>NO</option>
                              </select>
                            </div>
                            <div class="col-md-5 mb-3">
                              <label for="validationDefault01">Categoria</label>
                              <select class="form-control" name="categorie_id" required>
                                    @foreach(\App\Categorie::orderBy('title','asc')->cursor() as $cat)
                                    <option value="{{$cat->id}}" {{($post->categorie_id==$cat->id)?'selected':''}}>{{$cat->title}}</option>
                                    @endforeach
                              </select>
                            </div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{route('home')}}" class="btn btn-secundary">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
