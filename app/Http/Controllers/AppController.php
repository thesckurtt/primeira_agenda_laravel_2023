<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\PrimeiraAgenda\Estados;
use App\PrimeiraAgenda\Funcoes;
use App\Rules\telefone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    // ---------------------------------------------
    // Login
    // ---------------------------------------------
    public function login(Request $request)
    {
        if ($request->session()->has('logado') == true) {
            return redirect()->route('dashboard.index');
        }
        return view('login');
    }

    public function auth(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'O email não pode estar vazio',
            'email.email' => 'Coloque um email válido',
            'password.required' => 'A senha não pode estar vazia',
        ]);
        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            $request->session()->put('logado', true);
            return redirect()->intended('/');
        } else {
            $request->session()->put(
                'login_error',
                "Usuário e/ou senha incorretos"
            );
            return redirect()->back()->with(['error', 'Email e/ou senha incorretos'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    // ---------------------------------------------
    // Dashboard
    // ---------------------------------------------
    public function dashboard()
    {
        $funcoes = new Funcoes();
        $clientes = Cliente::all();
        $contatos_cadastro = Cliente::all()->count();
        $contatos_incompletos = Cliente::where(['email' => null])->count();
        $contatos_recentes = Cliente::select(
            'nome',
            'created_at',
            DB::raw('DATEDIFF(CURRENT_DATE(), DATE_FORMAT(created_at, "%Y/%m/%d/")) AS diferenca_dias')
        )
        ->whereRaw('DATEDIFF(CURRENT_DATE(), DATE_FORMAT(created_at, "%Y/%m/%d/")) <= 15')
        ->get()->count();

        $recentes = Cliente::where([
            'email' => null,
            'endereco_cep' => null,
            'endereco_rua' => null,
            'endereco_numero' => null,
            'endereco_bairro' => null,
            'endereco_cidade' => null,
            'endereco_estado' => null,
            'notas' => null,
        ])->count();

        return view('dashboard.index', [
            'contatos_cadastro' => $contatos_cadastro,
            'clientes' => $clientes,
            'contatos_incompletos' => $contatos_incompletos,
            'contatos_recentes' => $contatos_recentes,
            'funcoes' => $funcoes,
        ]);
    }

    public function cadastrar(Request $request)
    {

        if (!empty($request->input('nome') && $request->input('telefone'))) {
            if (!empty($request->input('telefone'))) {
                $telefone_clean = preg_replace('/[()\s-]/', "", $request->input('telefone'));
            }

            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:100|min:3',
                'telefone' => ['required', 'unique:clientes', 'min:14'], // min:14 para telefones residênciais que não possuem o 9 contanto com caracters especiais
                'email' => ['nullable', 'email'],
                'endereco_cep' => ['nullable', 'min:8'],
                'endereco_estado' => ['nullable', 'min:2'],
                'endereco_numero' => ['nullable', 'numeric'],

            ], [
                'nome.required' => 'O nome não pode estar vazio',
                'nome.max' => 'O nome não pode passar de 100 caracteres',
                'nome.min' => 'Insira seu nome completo',
                'telefone.required' => 'O telefone é obrigatório',
                'telefone.unique' => 'O telefone já está cadastrado',
                'telefone.min' => 'Número de telefone incompleto',
                'email.email' => 'Formato de email incorreto',
                'endereco_cep.min' => 'O CEP está incorreto',
                'endereco_numero.numeric' => 'Coloque apenas números',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }
            try {
                $cadastrar = Cliente::create([
                    'nome' => $request->input('nome'),
                    'telefone' => $telefone_clean,
                    'email' => $request->input('email'),
                    'endereco_cep' => $request->input('endereco_cep'),
                    'endereco_rua' => $request->input('endereco_rua'),
                    'endereco_numero' => $request->input('endereco_numero'),
                    'endereco_complemento' => $request->input('endereco_complemento'),
                    'endereco_bairro' => $request->input('endereco_bairro'),
                    'endereco_cidade' => $request->input('endereco_cidade'),
                    'endereco_estado' => $request->input('endereco_estado'),
                    'notas' => $request->input('notas'),
                ]);
                $request->session()->put('success', 'Usuário cadastrado com sucesso!');
                return redirect()->route('dashboard.index');
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->getCode() === '23000') {
                    $request->session()->put(
                        'telefone_error',
                        "Telefone já cadastrado!"
                    );
                }
                return redirect()->back()->withInput($request->input());
            }
        }

        return view('dashboard.cadastrar');
    }

    public function cadastro(Request $request, $id = null)
    {
        // Verifica se o id existe no banco de dados para apresentar ou não a view cadastro
        if (Cliente::where('id', '=', $id)->count() == 0) {
            return redirect()->route('dashboard.index');
        } else {
            $cliente_info = Cliente::where('id', '=', $id)->get();
            $estados_br = Funcoes::getEstados();
            // Retorna a view cadastro  com as informações do usuário referente ao ID passado
            return view('dashboard.cadastro', [
                'cliente_info' => $cliente_info,
                'estados_br' => $estados_br,
            ]);
        }
    }

    public function cadastroAtualizar(Request $request, $id = null)
    {
        // O método cadastroAtualizar serve para atualizar as informações do cliente no DB
        if (Cliente::where('id', '=', $id)->count() == 0) {
            return redirect()->route('dashboard.index');
        } else {
            if (!empty($request->input('nome') && $request->input('telefone'))) {

                // Remover caracteres especiais que vieram do input [telefone]
                if (!empty($request->input('telefone'))) {
                    $telefone_clean = preg_replace('/[()\s-]/', "", $request->input('telefone'));
                }

                $validator = Validator::make($request->all(), [
                    'nome' => 'required|max:100|min:3',
                    'telefone' => ['required', 'unique:clientes', 'min:14'], // min:14 para telefones residênciais que não possuem o 9 contanto com caracters especiais
                    'email' => ['nullable', 'email'],
                    'endereco_cep' => ['nullable', 'min:8'],
                    'endereco_estado' => ['nullable', 'min:2'],
                    'endereco_numero' => ['nullable', 'numeric'],

                ], [
                    'nome.required' => 'O nome não pode estar vazio',
                    'nome.max' => 'O nome não pode passar de 100 caracteres',
                    'nome.min' => 'Insira seu nome completo',
                    'telefone.required' => 'O telefone é obrigatório',
                    'telefone.unique' => 'O telefone já está cadastrado',
                    'telefone.min' => 'Número de telefone incompleto',
                    'email.email' => 'Formato de email incorreto',
                    'endereco_cep.min' => 'O CEP está incorreto',
                    'endereco_numero.numeric' => 'Coloque apenas números',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput($request->input());
                }
                try {
                    $cadastrar = Cliente::where('id', $id)->update([
                        'nome' => $request->input('nome'),
                        'telefone' => $telefone_clean,
                        'email' => $request->input('email'),
                        'endereco_cep' => $request->input('endereco_cep'),
                        'endereco_rua' => $request->input('endereco_rua'),
                        'endereco_numero' => $request->input('endereco_numero'),
                        'endereco_complemento' => $request->input('endereco_complemento'),
                        'endereco_bairro' => $request->input('endereco_bairro'),
                        'endereco_cidade' => $request->input('endereco_cidade'),
                        'endereco_estado' => $request->input('endereco_estado'),
                        'notas' => $request->input('notas'),
                    ]);
                    $request->session()->put('success', 'Usuário atualizado com sucesso!');
                    return redirect()->route('dashboard.index');
                } catch (\Illuminate\Database\QueryException $e) {
                    // TODO: implementar no front
                    // return redirect()->back()->with('error', 'Não foi possível cadastrar usuário');
                    if ($e->getCode() === '23000') {
                        $request->session()->put(
                            'telefone_error',
                            "Telefone já cadastrado!"
                        );
                    }
                    return redirect()->back()->withInput($request->input());
                    // return redirect()->back()->withErrors(($e->getCode() === '23000') ? 'E-mail já existe.' : '')->withInput($request->input());
                }
            }
        }
    }


    public function cadastroExcluir($id = null)
    {
        if (!empty($id)) {
            if (Cliente::where('id', '=', $id)->count() == 0) {
                return redirect()->route('dashboard.index');
            }
            $registro = Cliente::where('id', '=', $id)->firstOrFail();
            $registro->delete();
            return redirect()->route('dashboard.index');
        }
        return redirect()->route('dashboard.index');
    }


}
