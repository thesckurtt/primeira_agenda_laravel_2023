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
