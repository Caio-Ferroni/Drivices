<x-header_admin pageTitle="Usuários" breadcrumb="Gerenciamento">
<x-content>

    @if(session('success'))
        <div class="dash-alert dash-alert-success">
            <i class="bi bi-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="dash-card">

        <div class="dash-card-header">
            <div>
                <div class="dash-card-title">
                    <i class="bi bi-people"></i>
                    Usuários cadastrados
                </div>
                <div class="dash-card-sub">Listagem completa de todos os usuários da plataforma</div>
            </div>
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>CPF</th>
                        <th>Tipo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="dash-td-user">
                                    <div class="dash-td-ava">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="dash-td-name">{{ $user->name }}</div>
                                        <div class="dash-td-sub">#{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <code class="dash-code">{{ $user->cpf ?? '—' }}</code>
                            </td>
                            <td>
                                @if($user->isAdmin())
                                    <span class="dash-badge dash-badge-purple">Administrador</span>
                                @elseif($user->isProfessional())
                                    <span class="dash-badge dash-badge-blue">Profissional</span>
                                @else
                                    <span class="dash-badge dash-badge-neutral">Usuário</span>
                                @endif
                            </td>
                            <td>
                                <div class="dash-td-actions">
                                    <a href="{{ route('users.show', $user->id) }}" class="dash-td-btn" title="Ver detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="dash-td-btn" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @can('delete', $user)
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir {{ $user->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dash-td-btn danger" title="Excluir">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="dash-table-empty">
                                    <i class="bi bi-people"></i>
                                    <div>Nenhum usuário encontrado</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-content>
</x-header_admin>