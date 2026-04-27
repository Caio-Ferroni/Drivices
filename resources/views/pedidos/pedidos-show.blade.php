<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Pedidos</h5>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Orcamento</th>
                    <th>Fazer Oferta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->orcamento }}</td>

                    <td><a href="{{ route('pedidos.ofertas.create', $pedido) }}">Fazer Oferta</a></td>

                </tr>
            </tbody>
        </table><br>
        <table>


        </table>
        <button class="w3-button w3-dark-grey">Mais Usuarios<i class="fa fa-arrow-right"></i></button>
    </div>
</x-page_content>
<x-footer />
