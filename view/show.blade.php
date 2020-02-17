@extends('layouts.admin')
@section('title', 'Dispositivos')

@section('content')
<div class="content">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <h5 class="card-title">Código :{{ $data->id }}</h5>

            <p class="card-text"><b>Tipo do Processo:</b> {{$tipo_processo }}</p>
            <p class="card-text"><b>Tribunal:</b> {{ $court }}</p>
            <p class="card-text"><b>Número de exculção:</b> {{ $data->process_number }}</p>
            <p class="card-text"><b>Valor R$:</b> {{ $data->value }}</p>
            <p class="card-text"><b>Status:</b> {{ $status }}</p>
            <p class="card-text"><b>Devedor:</b> {{ $debtor->corporate_name}}</p>
            <p class="card-text"><b>Status:</b> {{ $data->updated_at }}</p>
            <p class="card-text"><b>Devedor:</b> {{ $data->updated_at }}</p>
            <div class="card-footer">
                <a href="{{ route('admin.processes_admin.index') }}" class="card-link">Voltar</a>
                <a href="{{ route('admin.processes_admin.edit',$data->id) }}" class="card-link">Editar</a>
            </div>

            
        </div>
    </div>
</div>
@endsection