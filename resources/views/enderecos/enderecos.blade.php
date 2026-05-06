<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Enderecos</h5>
        <a href="{{ route('enderecos.create') }}">Criar Endereço</a>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Complemento</th>
                    <th>Numero</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Região</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
           
            <tbody>
                {{ auth()->user()->hasEndereco() }}
               
                @foreach ($enderecos as $endereco)
                    <tr>
                         
                        <td>{{ $endereco->id }}</td>
                        <td>{{ $endereco->cep }}</td>
                        <td>{{ $endereco->logradouro }}</td>
                        <td>{{ $endereco->complemento ? $endereco->complemento : 'Sem Complemento'}}</td>
                        <td>{{ $endereco->bairro }}</td>
                        <td>{{ $endereco->localidade }}</td>
                        <td>{{ $endereco->uf }}</td>
                        <td>{{ $endereco->regiao }}</td>
                        <td><a href="{{ route('enderecos.show', $endereco->id) }}">Ver</a></td>
                        <td><a href="{{ route('enderecos.edit', $endereco->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>

        <button class="w3-button w3-dark-grey">Mais Usuarios<i class="fa fa-arrow-right"></i></button>
    </div>
</x-page_content>
<x-footer />
