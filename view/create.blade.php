@extends('layouts.admin')
@section('title', 'Processos')

@section('content')
<div class="content">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <h5 class="card-title">Novo Processo</h5>

            <p class="card-text">
                {!! Form::open(['route' => 'admin.processes_admin.store']) !!}

                @include('admin.processes_admin._form')

            </p>
            {!! Form::submit('Salvar', ['class' => 'card-link btn btn-primary']) !!}

            <a href="{{ route('admin.processes_admin.index') }}" class="card-link">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection