<form action="{{ route('professionals.update', ['professional' => $professional]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="biografia" placeholder="biografia">
    <button type="submit">Enviar</button>
</form>