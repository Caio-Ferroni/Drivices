@props([
    'hintLinkText' => null,
    'hint'         => null,
    'hintLinkRoute' => null,
])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Drivices</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&family=Lexend:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
</head>
<body class="auth-body">

<nav class="auth-topbar">
    <a class="nav-logo" href="{{ url('/') }}">Drivices<span class="dot">.</span></a>

    @if($hintLinkText)
        <div class="auth-topbar-hint">
            {{ $hint }} <a href="{{ route($hintLinkRoute) }}">{{ $hintLinkText }}</a>
        </div>
    @endif
</nav>

<main class="auth-main">
    {{ $slot }}
</main>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/masks.js') }}"></script>
</body>
</html>