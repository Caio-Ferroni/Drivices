<form action="{{ route('servicos.store') }}" method="POST">
    @csrf
    <input type="text" hidden name="pedido_id" value="{{ $request->pedido->id}}">
    <input type="text" hidden name="oferta_id" value="{{ $request->id}}">
    
    <button type="submit">Enviar</button>
</form>