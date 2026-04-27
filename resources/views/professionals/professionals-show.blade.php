<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Profissionais</h5>
        <a href="{{ route('professionals.create') }}">Criar Profissional</a>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Biografia</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ $professional->id }}</td>
                        <td>{{ $professional->user->name }}</td>
                        <td>{{ $professional->biografia }}</td>
                        <td><a href="{{ route('professionals.edit', $professional->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST">
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
