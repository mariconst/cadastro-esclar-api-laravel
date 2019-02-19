@extends('templates.template')

@section('content')
<h1>Cadastro de Estudante</h1>
<hr>

        
        <button title="criar" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-square"></i></button>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Série</th>
                <th scope="col">Nascimento</th>
                <th scope="col">Mãe</th>
                <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudantes as $estudante)
                
                    <tr>
                        <th scope="row">{{$estudante->nome}}</th>
                        <td>{{$estudante->serie}}</td>
                        <td>{{$estudante->nascimento}}</td>
                        <td>{{$estudante->mae}}</td>
                        <td scope="col">
                            <a href="#" class="editar" title="editar"><i class="far fa-edit"></i></a>
                            <a href="{{route('estudantes.show', $estudante->id)}}"  title="ver"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

@endsection           
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Estudante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('estudantes')}}">
        {!! csrf_field() !!}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Nascimento</label>
                <input type="date" class="form-control" id="nascimento" name="nascimento">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Série</label>
                <input type="text" class="form-control" id="serie" name="serie">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Número</label>
                <input type="text" class="form-control" id="numero" name="numero">
            </div>
        </div>
        <div class="form-row">
            <label for="inputPassword4">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado">
            </div>
        </div>
        <hr>
        <p><strong>Dados da Mãe</strong></p>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Nome</label>
                <input type="text" class="form-control" id="mae" name="mae">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Cpf</label>
                <input type="text" class="form-control" id="cpf"  name="cpf">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Data pagamento</label>
                <input type="number" class="form-control" id="dia_pagamento" name="dia_pagamento" min="1" max="31" >
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

