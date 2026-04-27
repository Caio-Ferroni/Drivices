<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Ofertas</h5>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Custo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ $oferta->id }}</td>
                        <td>{{ $oferta->pedido_id }}</td>
                        <td>{{ $oferta->custo }}</td>
                        <td><a href="{{ route('ofertas.edit', $oferta->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
            </tbody>
        </table><br>

        <button class="w3-button w3-dark-grey">Mais Usuarios<i class="fa fa-arrow-right"></i></button>
    </div>
</x-page_content>
<x-footer />
