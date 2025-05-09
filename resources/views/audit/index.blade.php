@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Registro de Auditoría</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Modelo</th>
                <th>ID</th>
                <th>Cambios</th>
                <th>Fecha</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->model_type }}</td>
                <td>{{ $log->model_id }}</td>
                <td>
                    @if($log->action === 'update')
                        @foreach($log->new_values as $key => $value)
                            <strong>{{ $key }}:</strong> 
                            {{ json_encode($value) }}<br>
                        @endforeach
                    @elseif($log->action === 'create')
                        <small class="text-success">Nuevo registro</small>
                    @else
                        <small class="text-danger">Registro eliminado</small>
                    @endif
                </td>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->ip_address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $logs->links() }}
</div>
@endsection