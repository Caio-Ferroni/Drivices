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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->cpf }}</td>
                </tr>
            </tbody>
        </table><br>
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="w3-button w3-dark-grey">Mais Usuarios<i class="fa fa-arrow-right"></i></button>
    </div>
</x-page_content>
<x-footer />
