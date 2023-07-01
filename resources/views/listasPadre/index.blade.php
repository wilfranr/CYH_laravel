@extends('adminlte::page')

@section('content')
<div class="container">
    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    <h1>Listas padres</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listasPadre as $listaPadre)
                <tr>
                    <td>{{ $listaPadre->nombre }}</td>
                    <td>
                        <a href="{{ route('listasPadre.edit', $listaPadre) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('listasPadre.destroy', $listaPadre) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('listasPadre.create') }}" class="btn btn-primary">Crear Lista</a>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.delete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, bórralo'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                    //tiempo de espera para que se ejecute el submit
                    setTimeout(function() {
                        Swal.fire(
                            '¡Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                    }, 500);
                }
            })
        });
    });
</script>
@endsection