<form action="{{ route('enderecos.store') }}" method="POST">
    @csrf

    <input type="text" name="cep" placeholder="CEP">
    <input type="text" name="logradouro" placeholder="Logradouro">
    <input type="text" name="complemento" placeholder="Complemento">
    <input type="text" name="unidade" placeholder="Unidade">
    <input type="text" name="bairro" placeholder="Bairro">
    <input type="text" name="localidade" placeholder="Localidade">
    <input type="text" name="uf" placeholder="UF">
    <input type="text" name="regiao" placeholder="Região">
    <input type="text" name="user_id" hidden value="{{ auth()->user()->id }}">

    <button type="submit">enviar</button>
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
