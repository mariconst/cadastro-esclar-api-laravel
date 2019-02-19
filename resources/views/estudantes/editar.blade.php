@extends('templates.template')

@section('content')
@if (isset($errors) && count($errors) > 0){
    @foreach($errors->all() as $error){
        <p>{{$error}}</p>
    }
    @endforeach
}
@endif
<h1>Edição de estudante</h1>
<hr>
<div class="d-flex justify-content-center form_container">
        <form method="post" action="{{route('estudantes.update')}}">
        {!! csrf_field() !!}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{$estudante->nome}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Nascimento</label>
                <input type="date" class="form-control" id="nascimento" name="nascimento"  value="{{$estudante->nascimento}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Série</label>
                <input type="text" class="form-control" id="serie" name="serie" value="{{$estudante->serie}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" value="{{$estudante->cep}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" value="{{$estudante->rua}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{$estudante->numero}}">
            </div>
        </div>
        <div class="form-row">
            <label for="inputPassword4">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="{{$estudante->complemento}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="{{$estudante->bairro}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="{{$estudante->cidade}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="{{$estudante->estado}}">
            </div>
        </div>
        <hr>
        <p><strong>Dados da Mãe</strong></p>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Nome</label>
                <input type="text" class="form-control" id="mae"  name="mae" value="{{$estudante->mae}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Cpf</label>
                <input type="text" class="form-control" id="cpf"  name="cpf" value="{{$estudante->cpf}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Data pagamento</label>
                <input type="number" class="form-control" id="dia_pagamento" name="dia_pagamento" value="{{$estudante->dia_pagamento}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        <div class="modal-footer">
        {!! Form::open(['route' => ['estudantes.destroy', $estudante->id_estudante], 'method' => 'DELETE']) !!}
            {!! Form::submit ("Excluiar", ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
       
      </div>
</div>
@endsection 