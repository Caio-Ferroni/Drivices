<h1>HOME</h1>
@auth
    <h1>Logado Com Sucesso: {{ auth()->user()->name }}</h1>
    <a href="{{ route('area-segura') }}">Area Segura</a>
    @if (!auth()->user()->email_verified_at)
        <a href="{{ route('verificacao-email') }}">Verifique seu email</a>
    @else
    <h1>Seu email está verificado</h1>
    @endif

    <form action="{{ route('logout') }}" method="POST">
        <button type="submit">logout</button>
    </form>

    <a href="{{ route('users.index') }}">Listagem</a>
@endauth



@guest
    <h1>você não está logado</h1>
    <a href="{{ route('login') }}">login</a>
    <a href="{{ route('password.request') }}">esqueci a senha</a>
    <a href="{{ route('register') }}">Registrar</a>

@endguest
