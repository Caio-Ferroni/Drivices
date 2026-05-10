<x-header_admin pageTitle="Pedidos" breadcrumb="Detalhes">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pedidos.index') }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="row g-4">

        {{-- ── CARD: PEDIDO ── --}}
        <div class="col-12">
            <div class="dash-card">

                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="bi bi-clipboard-text"></i>
                        Pedido #{{ $pedido->id }}
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @can('is_professional')
                            <a href="{{ route('pedidos.ofertas.create', $pedido) }}" class="btn-dash-primary">
                                <i class="bi bi-tags"></i>
                                Fazer Oferta
                            </a>
                        @endcan
                        @can('update', $pedido)
                            <a href="{{ route('pedidos.edit', $pedido) }}" class="btn-dash-action edit">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="dash-card-body">

                    {{-- USUÁRIO VINCULADO ── --}}
                    <div class="dash-show-user-row">
                        <div class="dash-td-ava dash-td-ava-lg">
                            {{ strtoupper(substr($pedido->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="dash-show-user-name">{{ $pedido->user->name }}</div>
                            <div class="dash-td-sub">Solicitante</div>
                        </div>
                        @if($pedido->emergencia)
                            <span class="dash-badge dash-badge-red ms-auto">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Emergência
                            </span>
                        @else
                            <span class="dash-badge dash-badge-neutral ms-auto">Normal</span>
                        @endif
                    </div>

                    <hr class="dash-divider">

                    <div class="row g-4">

                        <div class="col-md-4">
                            <div class="dash-show-field">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    @php
                                        $statusMap = [
                                            'aberto'       => 'dash-badge-green',
                                            'em_andamento' => 'dash-badge-blue',
                                            'concluido'    => 'dash-badge-neutral',
                                            'cancelado'    => 'dash-badge-red',
                                        ];
                                        $badgeClass = $statusMap[$pedido->status] ?? 'dash-badge-neutral';
                                    @endphp
                                    <span class="dash-badge {{ $badgeClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $pedido->status ?? '—')) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dash-show-field">
                                <div class="detail-label">Orçamento</div>
                                <div class="detail-value">
                                    R$ {{ number_format($pedido->orcamento, 2, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="dash-show-field">
                                <div class="detail-label">Data Preferida</div>
                                <div class="detail-value">
                                    {{ $pedido->data_preferida
                                        ? \Carbon\Carbon::parse($pedido->data_preferida)->format('d/m/Y')
                                        : '—' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dash-show-field">
                                <div class="detail-label">Disponibilidade</div>
                                <div class="detail-value">{{ $pedido->disponibilidade ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dash-show-field">
                                <div class="detail-label">Descrição</div>
                                <div class="detail-value">{{ $pedido->descricao }}</div>
                            </div>
                        </div>

                    </div>
                </div>

                @can('delete', $pedido)
                    <div class="dash-card-footer">
                        <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST"
                              onsubmit="return confirm('Tem certeza que deseja excluir este pedido?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-dash-action delete">
                                <i class="bi bi-trash3"></i>
                                Excluir pedido
                            </button>
                        </form>
                    </div>
                @endcan

            </div>
        </div>

        {{-- ── CARD: ENDEREÇO (profissional e admin) ── --}}
        @canany(['is_professional', 'is_admin'])
            <div class="col-12">
                <div class="dash-card">

                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="bi bi-geo-alt"></i>
                            Endereço do solicitante
                        </div>
                    </div>

                    <div class="dash-card-body">
                        @if($pedido->user->hasEndereco())
                            <div class="row g-4">

                                <div class="col-md-3">
                                    <div class="dash-show-field">
                                        <div class="detail-label">CEP</div>
                                        <div class="detail-value">
                                            <code class="dash-code">{{ $pedido->user->endereco->cep }}</code>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="dash-show-field">
                                        <div class="detail-label">Logradouro</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->logradouro }}</div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="dash-show-field">
                                        <div class="detail-label">Unidade</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->unidade ?? '—' }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="dash-show-field">
                                        <div class="detail-label">Complemento</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->complemento ?? '—' }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="dash-show-field">
                                        <div class="detail-label">Bairro</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->bairro }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="dash-show-field">
                                        <div class="detail-label">Cidade</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->localidade }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="dash-show-field">
                                        <div class="detail-label">UF</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->uf }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="dash-show-field">
                                        <div class="detail-label">Região</div>
                                        <div class="detail-value">{{ $pedido->user->endereco->regiao }}</div>
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="dash-table-empty">
                                <i class="bi bi-geo-alt"></i>
                                <div>Este usuário não possui endereço cadastrado</div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @endcanany

    </div>

</x-content>
</x-header_admin>