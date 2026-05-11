<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Drivices — Encontre o profissional certo</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&family=Lexend:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
</head>
<body>

<nav class="navbar navbar-expand-lg site-navbar fixed-top">
    <div class="container-fluid px-5">

        <a class="nav-logo navbar-brand" href="{{ url('/') }}">Drivices<span class="dot">.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="nav-links navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#">Como funciona</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categorias</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Para profissionais</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Preços</a></li>
            </ul>

            <div class="nav-actions d-flex align-items-center gap-2">
                @auth
                    <span class="nav-user-greeting">Olá, {{ auth()->user()->name }}</span>
                    <a href="{{ route('users.show', auth()->id()) }}" class="btn btn-ghost">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-ghost-danger">
                            <i class="bi bi-box-arrow-right"></i>
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-custom">Criar conta grátis</a>
                @endauth
            </div>
        </div>

    </div>
</nav>