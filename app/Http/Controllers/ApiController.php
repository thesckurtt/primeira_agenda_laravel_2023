<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request, $telefone = null){
        if (Cliente::where('telefone', '=', $telefone)->count() == 0) {
            return response()->json([
                'error' => true,
            ]);
        }else{
            $cliente = Cliente::where('telefone', $telefone)->get();
            $cliente_info = new \stdClass;
            foreach($cliente as $key => $value){
                // informações pessoais
                $cliente->nome = $value->nome;
                $cliente->telefone = $value->telefone;
                $cliente->email = $value->email;
                // endereço
                $cliente->endereco_cep = $value->endereco_cep;
                $cliente->endereco_rua = $value->endereco_rua;
                $cliente->endereco_numero = $value->endereco_numero;
                $cliente->endereco_complemento = $value->endereco_complemento;
                $cliente->endereco_bairro = $value->endereco_bairro;
                $cliente->endereco_cidade = $value->endereco_cidade;
                $cliente->endereco_estado = $value->estado;
                // outros
                $cliente->notas = $value->notas;
                $cliente->created_at = $value->created_at;
                return response()->json([
                    'nome' => $cliente->nome,
                    'telefone' => $cliente->telefone,
                    'email' => $cliente->email,
                    'endereco_cep' => $cliente->endereco_cep,
                    'endereco_rua' => $cliente->endereco_rua,
                    'endereco_numero' => $cliente->endereco_numero,
                    'endereco_complemento' => $cliente->endereco_complemento,
                    'endereco_bairro' => $cliente->endereco_bairro,
                    'endereco_cidade' => $cliente->endereco_cidade,
                    'endereco_estado' => $cliente->endereco_estado,
                    'notas' => $cliente->notas,
                    'created_at' => $cliente->created_at,
                ]);
            }
          
        }

    }
}
