<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('process_type', 'Tipo de Processo:') !!}
        <select class="form-control" id="process_type" name="process_type">
            <option value="1">Liberado</option>
            <option value="2">Aguardando liberação</option>
            <option value="3">Não liberado</option>
        </select>

        @if ($errors->has('process_type'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('process_type') }}</strong>
        </span>
        @endif
    </div>

</div>

<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('number', 'Número do processo*:') !!}
        {!! Form::text('process_number', null, ['required' => true, 'class' => $errors->has('number') ? 'form-control
        is-invalid' : 'form-control']) !!}
        @if ($errors->has('number'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('number') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('execution_order_number', 'Número da ordem de execução:') !!}
        {!! Form::text('execution_order_number', null, ['required' => false, 'class' => $errors->has('execution_order_number') ?
        'form-control is-invalid' : 'form-control']) !!}
        @if ($errors->has('execution_order_number'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('execution_order_number') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('devedor', 'Devedor:') !!}

        {!! Form::label('devedor', 'Devedor:') !!}
        <select class="form-control" id="devedor" name="devedor">
            @foreach($debtors as $debtor)

            <option value="{{$debtor->id}}">{{$debtor->corporate_name}}</option>

            @endforeach
        </select>
    </div>
    @if ($errors->has('devedor'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('devedor') }}</strong>
    </span>
    @endif
</div>

<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('value', 'Valor:') !!}
        {!! Form::text('value', null, ['required' => false, 'class' => $errors->has('value') ? 'form-control is-invalid'
        : 'form-control']) !!}
        @if ($errors->has('value'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('value') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('cedente', 'Cedente:') !!}
        <select class="form-control" id="cedente" name="cedente">
            <option value="1">Cedente 1</option>
            <option value="2">Cedente 2</option>

        </select>
    </div>
</div>


<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('status', 'Status:') !!}
        <select class="form-control" id="status" name="status">
            <option value="1">Liberado</option>
            <option value="2">Aguardando liberação</option>
            <option value="3">Não liberado</option>
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-12">
        {!! Form::label('tribunal ', 'Tribunal :') !!}
        <select class="form-control" id="enumCourts" name="enumCourts">
            <option value="1">Tribunal 1</option>
            <option value="2">Tribunal 2</option>

        </select>
    </div>
</div>

</div>
</div>