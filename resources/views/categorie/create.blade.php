@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Crear Categoria</div>

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
                    <form method="post" action="{{route('categorie.store')}}">
                        @csrf
                        <div class="form-row justify-content-center">
                            <div class="col-md-10 mb-3">
                              <label for="validationDefault01">Titulo</label>
                              <input type="text" class="form-control" name="title" required>
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
