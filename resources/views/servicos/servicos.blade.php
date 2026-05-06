<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Usuarios</h5>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Oferta</th>
                    <th>Status</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <th>Concluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicos as $servico)
                <tr>
                    <td>{{ $servico->id }}</td>
                    <td>{{ $servico->pedido_id }}</td>
                    <td>{{ $servico->oferta_id }}</td>
                    <td>{{ $servico->status }}</td>
                    <td><a href="{{ route('servicos.show', $servico->id)}}">Ver</a></td>
                    <td><a href="{{ route('servicos.edit', $servico->id)}}">Editar</a></td>
                    <td>
                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Excluir
                            </button>
                        </form>
                    </td>
                    <td><a href="{{ route('servicos.concluir', $servico) }}">Concluir</a></td>
                </tr>
                @endforeach
            </tbody>
        </table><br>

        <button class="w3-button w3-dark-grey">Mais Usuarios<i class="fa fa-arrow-right"></i></button>
    </div>
</x-page_content>
<x-footer />