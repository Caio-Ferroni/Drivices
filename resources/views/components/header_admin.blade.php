<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title ?? 'Drivices — Dashboard' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Lexend:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
</head>
<body class="admin-body">

{{-- ════════ SIDEBAR ════════ --}}
<aside class="admin-sidebar">

    <div class="sidebar-logo">
        <a href="{{ url('/') }}" class="logo-text">Drivices<span class="dot">.</span></a>
        @can('is_admin')
            <span class="logo-admin-badge">ADMIN</span>
        @endcan
    </div>

    {{-- MINHA CONTA ── todos --}}
    <div class="sidebar-section-label">Minha Conta</div>

    <a href="{{ route('users.show', auth()->id()) }}"
       class="nav-item {{ Route::currentRouteName() === 'users.show' ? 'active' : '' }}">
        <i class="bi bi-person-circle nav-icon"></i>
        Meu Perfil
    </a>

    {{-- Criar perfil profissional: apenas usuários comuns sem perfil profissional --}}
    @cannot('is_admin')
        @cannot('is_professional')
            <a href="{{ route('professionals.create') }}"
               class="nav-item {{ Route::currentRouteName() === 'professionals.create' ? 'active' : '' }}">
                <i class="bi bi-briefcase-fill nav-icon"></i>
                Tornar-me Profissional
            </a>
        @endcannot
    @endcannot

    {{-- Criar endereço: usuários sem endereço (exceto profissional sem endereço também) --}}
    @if(!auth()->user()->hasEndereco())
        <a href="{{ route('enderecos.create') }}"
           class="nav-item {{ Route::currentRouteName() === 'enderecos.create' ? 'active' : '' }}">
            <i class="bi bi-geo-alt nav-icon"></i>
            Registrar Endereço
        </a>
    @endif

    {{-- ADMINISTRAÇÃO ── apenas admin --}}
    @can('is_admin')
        <div class="sidebar-section-label">Administração</div>

        <a href="{{ route('users.index') }}"
           class="nav-item {{ Route::currentRouteName() === 'users.index' ? 'active' : '' }}">
            <i class="bi bi-people nav-icon"></i>
            Usuários
        </a>

        <a href="{{ route('enderecos.index') }}"
           class="nav-item {{ Route::currentRouteName() === 'enderecos.index' ? 'active' : '' }}">
            <i class="bi bi-geo-alt nav-icon"></i>
            Endereços
        </a>
    @endcan

    {{-- EXPLORAR ── não-admins --}}
    @cannot('is_admin')
        <div class="sidebar-section-label">Explorar</div>
    @endcannot

    {{-- Profissionais: todos --}}
    <a href="{{ route('professionals.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'professionals.index' ? 'active' : '' }}">
        <i class="bi bi-briefcase nav-icon"></i>
        Profissionais
    </a>

    {{-- OPERAÇÕES ── todos --}}
    <div class="sidebar-section-label">Operações</div>

    <a href="{{ route('pedidos.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'pedidos.index' ? 'active' : '' }}">
        <i class="bi bi-clipboard2-check nav-icon"></i>
        @can('is_professional')
            Pedidos Disponíveis
        @elsecan('is_admin')
            Pedidos
        @else
            Meus Pedidos
        @endcan
    </a>

    {{-- Fazer pedido: apenas usuários comuns --}}
    @cannot('is_professional')
        @cannot('is_admin')
            <a href="{{ route('pedidos.create') }}"
               class="nav-item {{ Route::currentRouteName() === 'pedidos.create' ? 'active' : '' }}">
                <i class="bi bi-clipboard-plus nav-icon"></i>
                Fazer Pedido
            </a>
        @endcannot
    @endcannot

    <a href="{{ route('servicos.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'servicos.index' ? 'active' : '' }}">
        <i class="bi bi-tools nav-icon"></i>
        Serviços
    </a>

    <a href="{{ route('relatorios.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'relatorios.index' ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text nav-icon"></i>
        Relatórios
    </a>

    {{-- RODAPÉ DA SIDEBAR ── --}}
    <div class="sidebar-bottom">

        {{-- Voltar à home --}}
        <a href="{{ url('/') }}" class="nav-item">
            <i class="bi bi-house nav-icon"></i>
            Página inicial
        </a>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-item nav-item-btn w-100">
                <i class="bi bi-box-arrow-right nav-icon"></i>
                Sair
            </button>
        </form>

        {{-- Perfil do usuário logado --}}
        <div class="admin-profile mt-2">
            <div class="admin-ava">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="admin-profile-info">
                <div class="admin-name">{{ auth()->user()->name }}</div>
                <div class="admin-role">
                    @can('is_admin')
                        Administrador
                    @elsecan('is_professional')
                        Profissional
                    @else
                        Usuário
                    @endcan
                </div>
            </div>
        </div>

    </div>

</aside>

{{-- ════════ MAIN WRAPPER ════════ --}}
<div class="admin-main">

    <header class="admin-topbar">
        <div class="topbar-left">
            <div class="page-title">{{ $pageTitle ?? 'Dashboard' }}</div>
            @isset($breadcrumb)
                <span class="page-breadcrumb">/ {{ $breadcrumb }}</span>
            @endisset
        </div>

        <div class="topbar-date d-none d-lg-block">
            {{ now()->locale('pt_BR')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
        </div>

        <div class="topbar-right">
            <button class="icon-btn" title="Notificações">
                <i class="bi bi-bell"></i>
                <span class="notif-dot"></span>
            </button>
            <div class="topbar-ava" title="{{ auth()->user()->name }}">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        </div>
    </header>

    {{-- CONTEÚDO DA PÁGINA --}}
    {{ $slot }}

</div>{{-- /admin-main --}}

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/masks.js') }}"></script>
@stack('scripts')

</body>
</html>