<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
class IndexDashboardScripts extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $contatos_cadastro = Cliente::all()->count();
        $contatos_incompletos = Cliente::whereRaw(
            'email is null or
            endereco_cep is null or
            endereco_rua is null or
            endereco_numero is null or
            endereco_bairro is null or
            endereco_cidade is null or
            endereco_estado is null'
        )->count();
        $contatos_recentes = Cliente::select(
            'nome',
            'created_at',
            DB::raw('DATEDIFF(CURRENT_DATE(), DATE_FORMAT(created_at, "%Y/%m/%d/")) AS diferenca_dias')
        )
            ->whereRaw('DATEDIFF(CURRENT_DATE(), DATE_FORMAT(created_at, "%Y/%m/%d/")) <= 15')
            ->get()->count();
        return view('components.index-dashboard-scripts', [
            'contatos_cadastro' => $contatos_cadastro,
            'contatos_incompletos' => $contatos_incompletos,
            'contatos_recentes' => $contatos_recentes,
        ]);
    }
}
