<form action="{{ route('relatorios.update', $relatorio) }}" method="POST">
    @csrf
    <input type="text" name="relatorio" placeholder="Descreva o que foi feito"  {{ old('relatorio', $relatorio->relatorio) }}>
    
    <button type="submit">Enviar</button>
</form>