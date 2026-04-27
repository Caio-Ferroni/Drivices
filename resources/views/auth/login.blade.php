<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" required placeholder="E-mail">
    <input type="password" name="password" required placeholder="Senha">

    <button type="submit">Entrar</button>
</form>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
