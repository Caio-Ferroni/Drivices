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

    {{-- LOGO --}}
    <div class="sidebar-logo">
        <a href="{{ url('/') }}" class="logo-text">Drivices<span class="dot">.</span></a>
        @can('is_admin')
            <span class="logo-admin-badge">ADMIN</span>
        @endcan
    </div>

    {{-- MEU PERFIL — todos os usuários --}}
    <div class="sidebar-section-label">Minha Conta</div>
    <a href="{{ route('users.show', auth()->id()) }}"
       class="nav-item {{ Route::currentRouteName() === 'users.show' ? 'active' : '' }}">
        <i class="bi bi-person-circle nav-icon"></i>
        Meu Perfil
    </a>

    {{-- USUÁRIOS — apenas admin --}}
    @can('is_admin')
        <div class="sidebar-section-label">Administração</div>
        <a href="{{ route('users.index') }}"
           class="nav-item {{ Route::currentRouteName() === 'users.index' ? 'active' : '' }}">
            <i class="bi bi-people nav-icon"></i>
            Usuários
        </a>
    @endcan

    {{-- PROFISSIONAIS — todos os usuários --}}
    @cannot('is_admin')
        <div class="sidebar-section-label">Explorar</div>
    @endcannot
    <a href="{{ route('professionals.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'professionals.index' ? 'active' : '' }}">
        <i class="bi bi-briefcase nav-icon"></i>
        Profissionais
    </a>

    {{-- OPERAÇÕES --}}
    <div class="sidebar-section-label">Operações</div>

    {{-- PEDIDOS — todos os usuários, label muda para profissional --}}
    <a href="{{ route('pedidos.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'pedidos.index' ? 'active' : '' }}">
        <i class="bi bi-clipboard-text nav-icon"></i>
        @can('is_professional')
            Pedidos Disponíveis
        @else
            @can('is_admin')
                Pedidos
            @else
                Meus Pedidos
            @endcan
        @endcan
    </a>

    {{-- SERVIÇOS — todos os usuários --}}
    <a href="{{ route('servicos.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'servicos.index' ? 'active' : '' }}">
        <i class="bi bi-tools nav-icon"></i>
        Serviços
    </a>

    {{-- RELATÓRIOS — todos os usuários --}}
    <a href="{{ route('relatorios.index') }}"
       class="nav-item {{ Route::currentRouteName() === 'relatorios.index' ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text nav-icon"></i>
        Relatórios
    </a>

    {{-- PERFIL NO RODAPÉ DA SIDEBAR --}}
    <div class="sidebar-bottom">
        <div class="admin-profile">
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
            <i class="bi bi-chevron-right ms-auto" style="color: rgba(255,255,255,0.3); font-size: 12px;"></i>
        </div>
    </div>

</aside>

{{-- ════════ MAIN WRAPPER ════════ --}}
<div class="admin-main">

    {{-- TOPBAR --}}
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

    {{-- SLOT: conteúdo da página --}}
    {{ $slot }}