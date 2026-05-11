<x-header_admin pageTitle="Serviços" breadcrumb="Detalhes">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('servicos.index') }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="row g-4">

        {{-- ── CARD: SERVIÇO ── --}}
        <div class="col-12">
            <div class="dash-card">

                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="bi bi-tools"></i>
                        Serviço #{{ $servico->id }}
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @if(auth()->user()->can('is_admin') || (auth()->user()->can('is_professional') && auth()->user()->professional->id === $servico->oferta->professional_id))
                            @if($servico->status !== 'concluido')
                                <a href="{{ route('servicos.concluir', $servico) }}"
                                   class="btn-dash-action edit"
                                   onclick="return confirm('Confirmar conclusão deste serviço?');">
                                    <i class="bi bi-check-circle"></i>
                                    Concluir
                                </a>
                            @endif
                        @endif
                        @can('is_admin')
                            <a href="{{ route('servicos.edit', $servico->id) }}" class="btn-dash-action edit">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="dash-card-body">

                    {{-- USUÁRIO E PROFISSIONAL ── --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="dash-show-user-row">
                                <div class="dash-td-ava dash-td-ava-lg">
                                    {{ strtoupper(substr($servico->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="dash-show-user-name">{{ $servico->user->name }}</div>
                                    <div class="dash-td-sub">Solicitante</div>
                                </div>
                                <a href="{{ route('users.show', $servico->user->id) }}" class="btn-dash-action edit ms-auto">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dash-show-user-row">
                                <div class="dash-td-ava dash-td-ava-lg" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                                    {{ strtoupper(substr($servico->professional->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="dash-show-user-name">{{ $servico->professional->user->name }}</div>
                                    <div class="dash-td-sub">Profissional</div>
                                </div>
                                <a href="{{ route('professionals.show', $servico->professional->id) }}" class="btn-dash-action edit ms-auto">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="dash-divider">

                    <div class="row g-4">

                        {{-- STATUS ── --}}
                        <div class="col-md-4">
                            <div class="dash-show-field">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    @php
                                        $statusMap = [
                                            'em_andamento' => 'dash-badge-blue',
                                            'concluido'    => 'dash-badge-green',
                                            'cancelado'    => 'dash-badge-red',
                                            'pendente'     => 'dash-badge-amber',
                                        ];
                                        $badgeClass = $statusMap[$servico->status] ?? 'dash-badge-neutral';
                                    @endphp
                                    <span class="dash-badge {{ $badgeClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $servico->status ?? '—')) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- CONFIRMAÇÃO ── --}}
                        <div class="col-md-4">
                            <div class="dash-show-field">
                                <div class="detail-label">Data de confirmação</div>
                                <div class="detail-value">
                                    @if($servico->confirmacao)
                                        <span class="dash-badge dash-badge-green">
                                            <i class="bi bi-check-circle"></i>
                                            {{ \Carbon\Carbon::parse($servico->confirmacao)->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="dash-badge dash-badge-neutral">Pendente</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- CUSTO ── --}}
                        <div class="col-md-4">
                            <div class="dash-show-field">
                                <div class="detail-label">Valor cobrado</div>
                                <div class="detail-value dash-td-currency">
                                    R$ {{ number_format($servico->oferta->custo, 2, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        {{-- PEDIDO ── --}}
                        <div class="col-md-6">
                            <div class="dash-show-field">
                                <div class="detail-label">Pedido vinculado</div>
                                <div class="detail-value">
                                    <a href="{{ route('pedidos.show', $servico->pedido_id) }}" class="dash-link">
                                        Pedido #{{ $servico->pedido_id }}
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- OFERTA ── --}}
                        <div class="col-md-6">
                            <div class="dash-show-field">
                                <div class="detail-label">Oferta aceita</div>
                                <div class="detail-value">
                                    <a href="{{ route('ofertas.show', $servico->oferta_id) }}" class="dash-link">
                                        Oferta #{{ $servico->oferta_id }}
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @can('is_admin')
                    <div class="dash-card-footer">
                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST"
                              onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-dash-action delete">
                                <i class="bi bi-trash3"></i>
                                Excluir serviço
                            </button>
                        </form>
                    </div>
                @endcan

            </div>
        </div>

        {{-- ── CARD: RELATÓRIO ── --}}
        <div class="col-12">
            <div class="dash-card">

                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="bi bi-file-earmark-text"></i>
                        Relatório
                    </div>
                    @if($servico->relatorio)
                        <a href="{{ route('relatorios.show', $servico->relatorio->id) }}" class="btn-dash-action edit">
                            <i class="bi bi-box-arrow-up-right"></i>
                            Ver relatório completo
                        </a>
                    @elsecan('is_professional')
                        <a href="{{ route('servicos.relatorios.create', $servico) }}" class="btn-dash-primary">
                            <i class="bi bi-plus-lg"></i>
                            Gerar relatório
                        </a>
                    @endif
                </div>

                <div class="dash-card-body">
                    @if($servico->relatorio)
                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="dash-show-field">
                                    <div class="detail-label">Status</div>
                                    <div class="detail-value">
                                        @php
                                            $rStatusMap = [
                                                'pendente'  => 'dash-badge-amber',
                                                'aprovado'  => 'dash-badge-green',
                                                'reprovado' => 'dash-badge-red',
                                                'concluido' => 'dash-badge-neutral',
                                            ];
                                            $rBadgeClass = $rStatusMap[$servico->relatorio->status] ?? 'dash-badge-neutral';
                                        @endphp
                                        <span class="dash-badge {{ $rBadgeClass }}">
                                            {{ ucfirst($servico->relatorio->status ?? '—') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="dash-show-field">
                                    <div class="detail-label">Descrição</div>
                                    <div class="detail-value">{{ $servico->relatorio->relatorio }}</div>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="dash-table-empty">
                            <i class="bi bi-file-earmark-text"></i>
                            <div>Nenhum relatório gerado para este serviço</div>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>

</x-content>
</x-header_admin>