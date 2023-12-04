<?php
use App\PrimeiraAgenda;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<x-HeadHTML />

<body>
    <x-HeaderDashboardSite />

    <section class="infos-cards limit">
        <div class="card-numero">
            <span class="span-card-numero-titulo">Contatos Cadastrados</span>
            <span id="contatos-cadastro" class="span-card-numero">0</span>
        </div>
        <div class="card-numero">
            <span class="span-card-numero-titulo">Contatos Incompletos</span>
            <span id="contatos-incompletos" class="span-card-numero">0</span>
        </div>
        <div class="card-numero">
            <span class="span-card-numero-titulo">Contatos Recentes</span><br>
            <span id="contatos-recentes" class="span-card-numero">0</span>
            <span style="font-size: 0.7em;font-style: italic;">*Nos ultimos 15 dias</span>
        </div>
    </section>

    {{-- Section Mensagens --}}
    @if (session()->has('success') || session()->has('fail'))
        <section class="section-mensagens limit">
            <div class="alert-success  .alert-success ">
                <div>
                    <i style="font-size: 1.9em" class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ session()->get('success') ?? session()->get('fail') }}</span>
                </div><i class="fa-solid fa-xmark" data-btn-id="close-alert-error"></i>
            </div>
        </section>
        @php
            session()->pull('success');
        @endphp
    @endif

    <section class="head-table-bar limit">
        <nav class="navbar navbar-light bg-dark justify-content-between">
            <a href="{{ route('dashboard.cadastrar') }}" type="button" class="btn btn-success"><i
                    class="fa-solid fa-plus"></i> Adicionar Cadastro</a>
            <form class="form-inline">
                <div class="div-search-table">
                    <input id="customSearchInput" class="form-control mr-sm-2" type="search" placeholder="Pesquisar..."
                        aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </form>
        </nav>
    </section>
    <table id="myTable" class="table table-dashboard-lista limit">
        <thead>
            <tr>
                <th class="table-dark" scope="col">ID</th>
                <th class="table-dark" scope="col">Nome</th>
                <th class="table-dark" scope="col">Data do cadastro</th>
                <th class="table-dark" scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <?php
                $carbon_data = function ($data) {
                    return \Carbon\Carbon::parse($data)->format('d/m/Y');
                };
                ?>
                <tr>
                    <th scope="row">{{ $cliente->id }}</th>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $carbon_data($cliente->created_at) }}</td>
                    <td class="control-btns-table">
                        <a href="{{ $funcoes::getWhatsAppLinkForNum($cliente->telefone) }}" target="_blank"
                            data-id="{{ $cliente->id }}" class="btn btn-success">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <button type="button" data-id="{{ $cliente->id }}" class="btn btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i>
                            Editar</button>
                        <button type="button" data-id="{{ $cliente->id }}" class="btn btn-danger"><i
                                class="fa-solid fa-trash"></i>
                            Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-IndexDashboardScripts />
</body>

</html>
