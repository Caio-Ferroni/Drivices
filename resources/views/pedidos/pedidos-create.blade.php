<form action="{{ route('pedidos.store') }}" method="POST">
    @csrf

    <input type="text" name="descricao" placeholder="descricao">
    <input type="text" name="cupon_id" placeholder="cupom">
    <input type="text" name="orcamento" placeholder="100.00">
    <input type="file" name="foto" placeholder="imagem">
    <label for="emergencia">Emergencia?</label>
    <select name="emergencia" id="options">
        <option value="1">Sim</option>
        <option value="0">Não</option>
    </select>
    <label for="disponibilidade">Horario Preferido</label>
    <select name="disponibilidade" id="options">
        <option value="Manha">Manhã</option>
        <option value="Tarde">Tarde</option>
        <option value="Noite">Noite</option>
    </select>
    <input type="date" id="data_preferida" name="data_preferida">

    <input type="text" name="id" hidden value="{{ auth()->user()->id }}">

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
