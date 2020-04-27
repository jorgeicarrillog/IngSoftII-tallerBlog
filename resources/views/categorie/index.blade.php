@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard - Listado de Categorias</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <a href="{{route('categorie.create')}}" class="btn btn-primary pull-right">Crear</a>
                    <table class="table responsive">
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Posts</th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->posts()->count()}}</td>
                            <td>
                                <a href="{{route('categorie.edit',$post->id)}}" class="btn btn-dark"><i class="fas fa-edit"></i> Editar</a>
                                <button class="btn btn-danger" onclick="deleteCategorie('{{$post->id}}')"><i class="fas fa-minus-circle"></i> Eliminar</button>
                                <form id="delete-form-{{$post->id}}" action="{{ route('categorie.destroy', $post->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function deleteCategorie(id) {
        Swal.fire({
          title: 'Esta seguro?',
          text: "Esta acción no se puede revertir!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar ahora!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {
            document.getElementById('delete-form-'+id).submit();
          }
        })
    }
</script>
@endsection
