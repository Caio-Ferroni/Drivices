<form action="{{ route('pedidos.ofertas.store', ['pedido' => $pedido]) }}" method="POST">
    @csrf
    <input type="text" name="professional_id" value="{{ auth()->user()->professional->id }}" hidden>
    <input type="text" name="custo" placeholder="custo">
    <button type="submit">Enviar</button>
</form>

 