<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\LawSuitRequest;
use Illuminate\Http\Request;
use App\Models\Debtor;
use App\Models\LawSuit;
use App\Models\Platform;
use App\Process;
use App\Exception;
use Illuminate\Support\Facades\Auth;

class ProcessAdminController extends Controller
{

    private $model;
    /**
     * @var Platform
     */
    private $platformModel;

    public function __construct(LawSuit $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $datatableConfig = $this->model->datatableConfig();
        return view('admin.processes_admin.index', compact('datatableConfig'));
    }

    public function create()
    {
        //recupera os devedores no banco de dados
        $debtors = Debtor::all();
        //passa para view os devedores 
        return view('admin.processes_admin.create', compact('debtors'));
    }
    public function store(LawSuitRequest $request)
    {

        $objeto = new LawSuit();
        //atribui aos campos os parametros vindo via request 
        $objeto->process_type  = $request->process_type;
        $objeto->process_number  = $request->process_number;
        $objeto->execution_order_number  = $request->execution_order_number;
        $objeto->debtors_id  = $request->devedor;
        $objeto->value  = $request->value;
        $objeto->court  = $request->enumCourts;
        $objeto->status  = $request->status;
        $objeto->debtors_id = $request->devedor;
        $objeto->users_id = Auth::id();
        //verifica se o objeto é vazio 
        if (empty($objeto)) {
            flash()->error('Erro  não encontrado');

            return redirect()->route('admin.processes_admin.index');
        } else {
            flash()->success('Cadastro com sucesso  atualizado com sucesso!');
            $objeto->save();

            return redirect()->route('admin.processes_admin.index');
        }
    }

    public function show($id)
    {


        //passa o ID vindo do table 
        $model = $this->model->find($id);
        //com base no id do debtorrs vindo do processo seta ele no debtor para obter assim o nome do debtor para exibir 
        $debtor = Debtor::findOrfail($model->debtors_id);
        //set o processo com base no numero vindo do banco de dados 

        if ($model->process_type === 1) {
            $tipo_processo = "Liberado";
            $numero = 1;
        } else if ($model->process_type === 2) {
            $tipo_processo = "Aguardando Liberação ";
            $numero = 2;
        } else {
            $tipo_processo = "Não Liberado ";
            $numero = 3;
        }

        //set o valor  com base no numero vindo do banco de dados 

        if ($model->court === 1) {
            $court = "Tribunal 1";
        } else if ($model->status === 2) {
            $court = "Tribunal 2  ";
        }
        //set o valor  com base no numero vindo do banco de dados 

        if ($model->status === 1) {
            $status = "Liberado";
        } else if ($model->status === 2) {
            $status = "Aguardando Liberação ";
        } else {
            $status = "Não Liberado ";
        }

        if (empty($model)) {
            flash()->error('Dispositivo não encontrado');
            return redirect()->route('admin.processes_admin.index');
        } else {
            return view('admin.processes_admin.show', compact('numero', 'debtor', 'court', 'status', 'tipo_processo'))->with('data', $model);
        }
    }

    public function edit($id)
    {

        //obtem os devedores 
        $debtors = Debtor::all();
        $statusOfProcess = LawSuit::getEnum('status');
        $data = LawSuit::findOrfail($id);

        if (empty($data)) {
            flash()->error('não encontrado');

            return redirect()->route('admin.processes_admin.index');
        }

        return view('admin.processes_admin.edit', compact('data',  'statusOfProcess', 'debtors'));
    }

    public function update($id, LawSuitRequest $request)
    {

        $objeto = new LawSuit();
        $input = $request->all();

        $objeto =  $objeto->findOrfail($id);


        $objeto->process_type  = $request->process_type;
        $objeto->process_number  = $request->process_number;
        $objeto->execution_order_number  = $request->execution_order_number;
        $objeto->debtors_id  = $request->devedor;
        $objeto->value  = $request->value;

        $objeto->court  = $request->enumCourts;

        $objeto->status  = $request->status;
        $objeto->debtors_id = $request->devedor;
        $objeto->users_id = Auth::id();



        if (empty($objeto)) {
            flash()->error('Dispositivo não encontrado');

            return redirect()->route('admin.processes_admin.index');
        }

        $objeto->save();

        flash()->success('Dispositivo atualizado com sucesso!');

        return redirect()->route('admin.processes_admin.index');
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);

        if (empty($model)) {
            flash()->error('Dispositivo não encontrado');
            return redirect()->route('admin.processes_admin.index');
        }

        $model->delete();

        flash()->success('Dispositivo excluído com sucesso!');

        return redirect()->route('admin.processes_admin.index');
    }


    private function getPlatforms()
    {
        return $this->platformModel->all();
    }

    public function datatable()
    {
        return $this->model->datatableRender();
    }
}
