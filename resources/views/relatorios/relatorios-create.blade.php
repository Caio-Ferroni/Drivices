<form action="{{ route('servicos.relatorios.store', $servico) }}" method="POST">
    @csrf
    <input type="text" hidden name="servico_id" value="{{ $servico->id }}">
    <input type="text" hidden name="status" value="{{ $servico->status }}">
    <input type="text" name="relatorio" placeholder="Descreva o que foi feito">
    <input type="file" name="foto">
    
    <button type="submit">Enviar</button>
</form>