<x-header_admin pageTitle="Relatórios" breadcrumb="Detalhes">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('relatorios.index') }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-file-earmark-text"></i>
                Relatório #{{ $relatorio->id }}
            </div>
            @can('is_admin')
                <a href="{{ route('relatorios.edit', $relatorio->id) }}" class="btn-dash-action edit">
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>
            @endcan
        </div>

        <div class="dash-card-body">

            {{-- CONTEXTO DO SERVIÇO ── --}}
            <div class="dash-show-user-row">
                <div class="dash-td-ava dash-td-ava-lg" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                    {{ strtoupper(substr($relatorio->servico->professional->user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="dash-show-user-name">{{ $relatorio->servico->professional->user->name }}</div>
                    <div class="dash-td-sub">Profissional responsável</div>
                </div>
                <a href="{{ route('servicos.show', $relatorio->servico_id) }}" class="btn-dash-action edit ms-auto">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Ver serviço
                </a>
            </div>

            <hr class="dash-divider">

            <div class="row g-4">

                {{-- SERVIÇO ── --}}
                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Serviço vinculado</div>
                        <div class="detail-value">
                            <a href="{{ route('servicos.show', $relatorio->servico_id) }}" class="dash-link">
                                Serviço #{{ $relatorio->servico_id }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- STATUS ── --}}
                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            @php
                                $statusMap = [
                                    'pendente'  => 'dash-badge-amber',
                                    'aprovado'  => 'dash-badge-green',
                                    'reprovado' => 'dash-badge-red',
                                    'concluido' => 'dash-badge-neutral',
                                ];
                                $badgeClass = $statusMap[$relatorio->status] ?? 'dash-badge-neutral';
                            @endphp
                            <span class="dash-badge {{ $badgeClass }}">
                                {{ ucfirst($relatorio->status ?? '—') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- RELATORIO ── --}}
                <div class="col-12">
                    <div class="dash-show-field">
                        <div class="detail-label">Descrição do serviço realizado</div>
                        <div class="detail-value">{{ $relatorio->relatorio ?? '—' }}</div>
                    </div>
                </div>

            </div>
        </div>

        @can('is_admin')
            <div class="dash-card-footer">
                <form action="{{ route('relatorios.destroy', $relatorio->id) }}" method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir este relatório?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-dash-action delete">
                        <i class="bi bi-trash3"></i>
                        Excluir relatório
                    </button>
                </form>
            </div>
        @endcan

    </div>

</x-content>
</x-header_admin>