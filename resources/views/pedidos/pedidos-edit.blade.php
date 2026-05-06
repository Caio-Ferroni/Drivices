<form action="{{ route('pedidos.update', $pedido) }}" method="POST">
    @method('PUT')
    @csrf

    <input type="text" name="descricao" placeholder="descricao" value="{{ old('descricao', $pedido->descricao) }}">
    <input type="text" name="orcamento" placeholder="100.00" value="{{ old('orcamento', $pedido->orcamento) }}">
    {{-- <input type="file" name="foto" placeholder="imagem" value="{{ old('foto', $pedido->foto) }}"> --}}
    <label for="emergencia">Emergencia?</label>
    <select name="emergencia" id="options" value="{{ old('emergencia', $pedido->emergencia) }}" >
        <option value="1">Sim</option>
        <option value="0">Não</option>
    </select>
    <label for="disponibilidade">Horario Preferido</label>
    <select name="disponibilidade" id="options" value="{{ old('disponibilidade', $pedido->disponibilidade) }}">
        <option value="Manha">Manhã</option>
        <option value="Tarde">Tarde</option>
        <option value="Noite">Noite</option>
    </select>
    <input type="date" id="data_preferida" name="data_preferida" value="{{ old('data_preferida', $pedido->data_preferida) }}">

    <button type="submit">enviar</button>
</form>