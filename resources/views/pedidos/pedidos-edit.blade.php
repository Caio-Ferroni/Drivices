<form action="{{ route('pedidos.update', $pedido) }}" method="POST">
    @method('PUT')
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

    <button type="submit">enviar</button>
</form>