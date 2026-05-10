<x-header_admin pageTitle="Profissionais" breadcrumb="Detalhes">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('professionals.index') }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-briefcase"></i>
                Perfil Profissional
            </div>
            @can('update', $professional)
                <a href="{{ route('professionals.edit', $professional->id) }}" class="btn-dash-action edit">
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>
            @endcan
        </div>

        <div class="dash-card-body">

            {{-- USUÁRIO VINCULADO ── --}}
            <div class="dash-show-user-row">
                <div class="dash-td-ava dash-td-ava-lg">
                    {{ strtoupper(substr($professional->user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="dash-show-user-name">{{ $professional->user->name }}</div>
                    <div class="dash-td-sub">{{ $professional->user->email }}</div>
                </div>
                <a href="{{ route('users.show', $professional->user->id) }}" class="btn-dash-action edit ms-auto">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Ver perfil de usuário
                </a>
            </div>

            <hr class="dash-divider">

            <div class="row g-4">

                <div class="col-12">
                    <div class="dash-show-field">
                        <div class="detail-label">Biografia</div>
                        <div class="detail-value">{{ $professional->biografia ?? '—' }}</div>
                    </div>
                </div>

            </div>

        </div>

        @can('delete', $professional)
            <div class="dash-card-footer">
                <form action="{{ route('professionals.destroy', $professional->id) }}" method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir este perfil profissional?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-dash-action delete">
                        <i class="bi bi-trash3"></i>
                        Excluir perfil
                    </button>
                </form>
            </div>
        @endcan

    </div>

</x-content>
</x-header_admin>