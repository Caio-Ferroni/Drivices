<x-header />
<x-page_content>
    <div class="w3-container">
        <h5>Usuarios</h5>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Tipo</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->cpf }}</td>
                    <td>{{  $user->isProfessional() ? 'Profissional' : $user->tipo }}</td>
                    <td><a href="{{ route('users.show', $user->id)}}">Ver</a></td>
                    <td><a href="{{ route('users.edit', $user->id)}}">Editar</a></td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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