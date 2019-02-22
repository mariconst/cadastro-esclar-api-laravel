<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudante;
use App\Models\Endereco;
use App\Models\Mae;

class EstudantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $estudante;
    private $endereco;
    private $mae;
    public function __construct(Estudante $estudante, Endereco $endereco, Mae $mae){
        $this->estudante = $estudante;
        $this->endereco = $endereco;
        $this->mae = $mae;
        
    }

    public function index()
    {   
        
        $estudantes = $this->estudante
        ->join('maes', 'maes.id', '=', 'estudantes.id_mae')
        ->select('estudantes.*', 'maes.id as id_mae', 'maes.nome as mae')
        ->get();
        return $estudantes;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Variável de retorno
        $msg = 'error';
        //Pega todos os dados do endereço
        $dataEndereco = [
            "cep" => $request->cep,
            "rua" => $request->rua,
            "numero" => $request->numero,
            "complemento" => $request->complemento,
            "bairro" => $request->bairro,
            "cidade" => $request->cidade,
            "estado" => $request->estado
        ];
       
        //Pega todos os dados da mãe
        $dataMae = [
            "nome" => $request->mae,
            "cpf" => $request->cpf,
            "dia_pagamento" => $request->dia_pagamento
        ];
       
        $insertEndereco = $this->endereco->create($dataEndereco);
        if($insertEndereco){
            $insertMae = $this->mae->create($dataMae);
            if($insertMae){
                //Pega todos os dados do estudante
                $dataEstudante = [
                        'nome' => $request->nome, 
                        'nascimento' =>  $request->nascimento, 
                        'serie' =>  $request->serie,
                        'id_endereco' => $insertEndereco->id,
                        'id_mae' => $insertMae->id
                    ];
                   
                return $insertEstudante = $this->estudante->create($dataEstudante);
                               
            }
        }
        
        return $msg;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //$estudante = $this->estudante->find($id);
      
        $estudante = $this->estudante
            ->join('maes', 'maes.id', '=', 'estudantes.id_mae')
            ->join('enderecos', 'enderecos.id', '=', 'estudantes.id_endereco')
            ->select('estudantes.*','maes.id as id_mae', 'maes.nome as mae', 'maes.cpf', 'maes.dia_pagamento', 'enderecos.id as id_endereco', 'enderecos.cep', 'enderecos.rua', 'enderecos.numero', 'enderecos.complemento', 'enderecos.bairro', 'enderecos.cidade', 'enderecos.estado')
            ->find($id);
         return $estudante;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 'a';exit;
        //PEGA ID MAE E ID ENDERECO DE ACORDO COM O ESTUDANTE
        $estudante = $this->estudante
            ->join('maes', 'maes.id', '=', 'estudantes.id_mae')
            ->join('enderecos', 'enderecos.id', '=', 'estudantes.id_endereco')
            ->select('maes.id as id_mae', 'maes.cpf as cpf', 'enderecos.id as id_endereco')
            ->find($id);

        //NOVOS DADOS DO ENDERECO
        $dataEndereco = [
            "cep" => $request->cep,
            "rua" => $request->rua,
            "numero" => $request->numero,
            "complemento" => $request->complemento,
            "bairro" => $request->bairro,
            "cidade" => $request->cidade,
            "estado" => $request->estado
        ];
        
        //NOVOS DADOS DA MAE
        //VERIFICA SE HOUVE ATUALIZAÇÃO DO CPF, POIS ELE É ÚNICO
        
        if($request->cpf == $estudante->cpf){
            $dataMae = [
                "nome" => $request->mae,
                "dia_pagamento" => $request->dia_pagamento
            ];
        }else{
            $dataMae = [
                "nome" => $request->mae,
                "cpf" => $request->cpf,
                "dia_pagamento" => $request->dia_pagamento
            ];
        }
        

        //NOVOS DADOS DO ESTUDANTE
        $dataEstudante = [
            'nome' => $request->nome, 
            'nascimento' =>  $request->nascimento, 
            'serie' =>  $request->serie 
        ];
        //UPDATE ENREÇO
        $this->endereco->where('id', $estudante->id_endereco)
                        ->update($dataEndereco);  

        //UPDATE MÃE
        $this->mae->where('id', $estudante->id_mae)
        ->update($dataMae);  
       
        //UPDATE ESTUDANTE
        return $this->estudante->where('id', $id)
        ->update($dataEstudante);  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        //PEGA ID MAE E ID ENDERECO DE ACORDO COM O ESTUDANTE
        $estudante = $this->estudante
        ->join('maes', 'maes.id', '=', 'estudantes.id_mae')
        ->join('enderecos', 'enderecos.id', '=', 'estudantes.id_endereco')
        ->select('maes.id as id_mae', 'enderecos.id as id_endereco')
        ->find($id);

        $this->estudante->find($id)->delete();

        //Verifica se a mãe pertence a mais de 1 estudante
        $numMae = $this->estudante
                     ->where('id_mae', '=', $estudante->id_mae)
                     ->count();
        if($numMae < 2){
           $this->mae->find($estudante->id_mae)->delete();
        }
         $this->endereco->find($estudante->id_endereco)->delete();
         return 204;
       
    }
}
