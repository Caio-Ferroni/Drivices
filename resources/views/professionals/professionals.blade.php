<x-header_admin pageTitle="Profissionais" breadcrumb="Gerenciamento">
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
                    <i class="bi bi-briefcase"></i>
                    Profissionais
                </div>
                <div class="dash-card-sub">
                    @can('is_admin')
                        Listagem completa de todos os profissionais da plataforma
                    @else
                        Encontre profissionais disponíveis para seu pedido
                    @endcan
                </div>
            </div>
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Profissional</th>
                        <th>Biografia</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($professionals as $professional)
                        <tr>
                            <td>
                                <div class="dash-td-user">
                                    <div class="dash-td-ava">
                                        {{ strtoupper(substr($professional->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="dash-td-name">{{ $professional->user->name }}</div>
                                        <div class="dash-td-sub">#{{ $professional->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dash-td-truncate" title="{{ $professional->biografia }}">
                                    {{ Str::limit($professional->biografia, 60) ?? '—' }}
                                </div>
                            </td>
                            <td>
                                <div class="dash-td-actions">
                                    <a href="{{ route('professionals.show', $professional->id) }}"
                                       class="dash-td-btn" title="Ver perfil">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @can('is_admin')
                                        <a href="{{ route('professionals.edit', $professional->id) }}"
                                           class="dash-td-btn" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este profissional?');">
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
                            <td colspan="3">
                                <div class="dash-table-empty">
                                    <i class="bi bi-briefcase"></i>
                                    <div>Nenhum profissional encontrado</div>
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