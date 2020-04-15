@extends('admin.layouts.app')
@section('content')
<h1 class="text-center my-2">Lista de Encuestas</h1>
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Encuestas</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Encuesta</th>
                        <th>Fecha de Creacion</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Encuesta</th>
                        <th>Fecha de Creacion</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($encuestas as $en)
                    <tr>
                        <td>{{$en->titulo}}</td>
                        <td>{{$en->fecha_creacion}}</td>
                        <td>{{$en->fecha_vencimiento}}</td>
                        <td>{{$en->estado}}</td>
                        <td>
                            <a href="" class="btn btn-primary"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                        
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
    } );
    </script>
@endpush
@endsection