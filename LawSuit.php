<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\EloquentDataTable;
use App\Datatables\DatatableModelTrait;
use App\Traits\Enums;
use Illuminate\Database\Eloquent\Builder;

class LawSuit extends Model
{

    use Enums;
    use DatatableModelTrait;
    // protected $enumStatuses = [
    //     '1' => 'Liberado',
    //     '2' => 'Aguardando liberação',
    //     '3' => 'Não liberado',
    // ];

    // protected $enumCourts = [
    //     '1' => 'Tribunal 1',
    //     '2' => 'Tribunal 2',
    // ];

    protected $fillable = [
        'code',
        'process_type',
        'court',
        'process_number',
        'execution_order_number',
        'value',
        'status',
        'debtors_id',
        'users_id',
    ];

    private function datatableRoutePrefix(): string
    {
        return "admin.processes_admin";
    }


    private function datatableConstruct(): EloquentDataTable
    {
        $datatable = $this->datatableMake();

        $datatable->editColumn('created_at', function ($row) {
            return $row->created_at ? $row->created_at->format('d/m/Y - H:i:s') : null;
        });
        // neste campo ele verifica e faz a formatação dos campos a serem exibidos na view process adimn na Table 
        $datatable->editColumn('updated_at', function ($row) {
            return $row->updated_at->format('d/m/Y - H:i:s');
        })->editColumn('process_type', function ($row) {
            if ($row->process_type == 1) {
                return 'Liberado';
            } else  if ($row->process_type == 2) {
                return 'Aguardando liberação';
            } else {
                return 'Não Liberado ';
            }
        })->editColumn('court', function ($row) {
            if ($row->process_type == 1) {
                return 'Tribunal 1';
            } else  if ($row->process_type == 2) {
                return 'Tribunal 2';
            }
        })
            ->make(true);


        return $datatable;
    }

    private function datatableQuery(): Builder
    {
        return $this->query();
    }

    private function datatableColumns(): array
    {
        //exibe na view index os campos cada campo é uma row no datatable 
        return [
            ['data' => 'id'],
            ['data' => 'process_type'],
            ['data' => 'court'],
            ['data' => 'process_number'],
            ['data' => 'execution_order_number'],
            ['data' => 'value'],



        ];
    }
}
