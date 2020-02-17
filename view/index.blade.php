@extends('layouts.admin')
@section('title', 'Processos')

@section('content')
<div class="content">
    <a href="{{ route('admin.processes_admin.create') }}" class="btn btn-primary mb-2 float-right"
        title="Cadastrar Novo">
        <i class="fas fa-plus"></i>
        Adicionar novo processo
    </a>
    <div class="clearfix"></div>

    <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table table-responsive-md table-striped datatable" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo de Processo</th>
                        <th scope="col">Tribual </th>
                        <th scope="col">Nº do Processo</th>
                        <th scope="col">Nº da Ordem</th>
                        <th scope="col">Valor R$</th>
                        <th scope="col">Detalhes</th>

                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
@endsection

@include('datatables.render', $datatableConfig)