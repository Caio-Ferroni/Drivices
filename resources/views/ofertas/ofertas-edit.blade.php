<form action="{{ route('ofertas.update', $oferta) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="custo" placeholder="custo" {{ old('custo', $oferta->custo) }}>
    <button type="submit">Enviar</button>
</form>