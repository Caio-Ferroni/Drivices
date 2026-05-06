<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Pedidos</h5>
        <a href="{{ route('pedidos.create') }}">Fazer Pedido</a>



        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Descrição</th>
                    <th>Ver</th>
                    <th>Ver Ofertas</th>
                    <th>Atualizar</th>
                    <th>Excluir</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    @can('view', $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->user->name }}</td>
                            <td>{{ $pedido->descricao }}</td>
                            <td><a href="{{ route('pedidos.show', $pedido) }}">Ver</a></td>
                            <td><a href="{{ route('pedidos.ofertas.index', $pedido) }}">Ver ofertas</a></td>
                            <td><a href="{{ route('pedidos.edit', $pedido) }}">Atualizar</a></td>
                            <td>
                                <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endcan
                @endforeach
            </tbody>
        </table>

        <br>

        <button class="w3-button w3-dark-grey">Mais Pedidos<i class="fa fa-arrow-right"></i></button>
    </div>
</x-page_content>
<x-footer />
