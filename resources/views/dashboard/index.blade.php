<?php
use App\PrimeiraAgenda;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('_dashboard/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('_dashboard/css/import.css') }}">
    <link rel="stylesheet" href="{{ asset('_dashboard/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('_dashboard/css/alert.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <title>Dashboard | Primeira Mesa</title>
</head>

<body>
    <header class="header-dashboard-site">
        <div class="limit-header">
            <div class="div-logo-container">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo Primeira Agenda">
            </div>
            <h1 class="h1-dashboard-site">Primeira Agenda</h1>
            <div class="div-usuario-info">
                <div class="alert-usuario-msg">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="div-usuario-avatar-img">
                    <img src="https://avatars.githubusercontent.com/u/36743233?v=4" alt="Foto de perfil">
                </div>
                <div class="usuario-informacoes">
                    <span class="header-span-usuario-nome">Mailan Franco</span>
                    <span class="header-span-usuario-cargo">Desenvolvedor</span>
                </div>
                <div id="header-menu-top" class="header-menu-top">
                    <img src="{{ asset('_dashboard/img/menu-dots.svg') }}" alt="" draggable="false">
                    <div id="menu-dropdown-header" class="list-group limit menu-dropdown-header hidden">
                        <a href="#" class="list-group-item list-group-item-action {{-- disabled --}}"><i
                                class="fa-solid fa-user"></i>Editar perfil</a>
                        <a href="#" class="list-group-item list-group-item-action {{-- disabled --}}"><i
                                class="fa-solid fa-gear"></i>Configurações</a>
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"><i
                                style="transform: rotate(-90deg);"
                                class="fa-solid fa-arrow-up-from-bracket"></i>Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
                        <a href="{{ $funcoes::getWhatsAppLinkForNum($cliente->telefone) }}"
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

            <?php /*
            <tr>
                <th scope="row">3</th>
                <td>Jõao Victor Fagundes </td>
                <td>12/07/2023</td>
                <td class="control-btns-table">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>
                        Editar</button>
                    <button type="button" data-id="3" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Excluir</button>
                </td>
            </tr>
*/
            ?>
        </tbody>
    </table>

    <?php // TODO: Menu suspenço com ações
    ?>
    <script>
        $(window).on('load', () => {
            if ($('.section-mensagens').css('display') == 'block') {
                // var section_mensagens = setInterval(() => {
                //     $('.alert-success').addClass('hidden-mensage-section');
                // }, 1000)
                $('.alert-success').animate({
                    opacity: 0,
                }, 5000, () => {
                    $('.section-mensagens').css('display', 'none');
                });
            }
        })
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                dom: '',
            });
            $('#customSearchInput').on('input', function() {
                table.search(this.value).draw();
            });
        });

        var btn_edit = document.querySelectorAll(".btn-primary");
        btn_edit.forEach(btn => {
            btn.addEventListener('click', () => {
                var data_id = btn.getAttribute('data-id');
                window.location.href = '{{ route('dashboard.cadastro') }}/' + data_id;

            })
        })

        var btn_delete = document.querySelectorAll('.btn-danger');
        btn_delete.forEach(btn => {
            btn.addEventListener('click', () => {
                var data_id = btn.getAttribute('data-id');
                console.log(data_id);

                // Animação para excluir linha
                $('[data-id="' + data_id + '"]').parent().parent().addClass("hidden-line-table");

                // Excluir registro
                $.ajax({
                    url: '<?= route('dashboard.cadastro_excluir') ?>/' + data_id,
                    context: document.body
                }).done(function() {
                    $('[data-id="' + data_id + '"]').parent().parent().hide()
                });
            })
        });
    </script>
    <?php // TODO: Colocar em um arquivo js externo
    ?>
    <script>
        function startCounting(targetValue, duration, elementId) {
            const element = document.getElementById(elementId);
            const startValue = 0;
            const intervalTime = 20; // intervalo de atualização em milissegundos
            const steps = Math.ceil(duration / intervalTime);
            const increment = (targetValue - startValue) / steps;
            let currentValue = startValue;
            const updateCounter = () => {
                element.textContent = Math.round(currentValue);

                if (currentValue < targetValue) {
                    currentValue += increment;
                    requestAnimationFrame(updateCounter);
                }
            };
            updateCounter();
        }

        var contadores = setInterval(() => {
            startCounting({{ $contatos_cadastro }}, 1000, 'contatos-cadastro');
            startCounting({{ $contatos_recentes }}, 1000, 'contatos-recentes');
            startCounting({{ $contatos_incompletos }}, 1000, 'contatos-incompletos');
            clearInterval(contadores);
        }, 250);
    </script>
    <script>
        $('#header-menu-top').click(() => {
            $('.menu-dropdown-header').toggleClass('hidden');
        });
        $('.menu-dropdown-header').on('mouseleave', () => {
            $('.menu-dropdown-header').addClass('hidden');
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</body>

</html>
