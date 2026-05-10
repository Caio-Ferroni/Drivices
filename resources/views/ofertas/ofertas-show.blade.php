<x-header_admin pageTitle="Ofertas" breadcrumb="Detalhes">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pedidos.ofertas.index', $oferta->pedido_id) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar às ofertas
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-tags"></i>
                Oferta #{{ $oferta->id }}
            </div>
            <div class="d-flex align-items-center gap-2">
                @can('update', $oferta)
                    <a href="{{ route('ofertas.edit', $oferta->id) }}" class="btn-dash-action edit">
                        <i class="bi bi-pencil"></i>
                        Editar
                    </a>
                @endcan
            </div>
        </div>

        <div class="dash-card-body">

            {{-- PROFISSIONAL ── --}}
            <div class="dash-show-user-row">
                <div class="dash-td-ava dash-td-ava-lg" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                    {{ strtoupper(substr($oferta->professional->user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="dash-show-user-name">{{ $oferta->professional->user->name }}</div>
                    <div class="dash-td-sub">Profissional responsável pela oferta</div>
                </div>
                <a href="{{ route('professionals.show', $oferta->professional->id) }}" class="btn-dash-action edit ms-auto">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Ver perfil
                </a>
            </div>

            <hr class="dash-divider">

            <div class="row g-4">

                {{-- PEDIDO ── --}}
                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Pedido vinculado</div>
                        <div class="detail-value">
                            <a href="{{ route('pedidos.show', $oferta->pedido_id) }}" class="dash-link">
                                Pedido #{{ $oferta->pedido_id }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- CUSTO ── --}}
                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Valor da oferta</div>
                        <div class="detail-value dash-td-currency">
                            R$ {{ number_format($oferta->custo, 2, ',', '.') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="dash-card-footer d-flex justify-content-between align-items-center">

            {{-- ACEITAR: usuário dono do pedido e admin ── --}}
            @if(auth()->user()->can('is_admin') || auth()->id() === $oferta->pedido->user_id)
                <form action="{{ route('ofertas.aceitar', $oferta) }}" method="POST"
                      onsubmit="return confirm('Tem certeza que deseja aceitar esta oferta? Um serviço será gerado automaticamente.');">
                    @csrf
                    <button type="submit" class="btn-dash-primary">
                        <i class="bi bi-check-circle"></i>
                        Aceitar oferta
                    </button>
                </form>
            @else
                <div></div>
            @endif

            {{-- EXCLUIR: profissional da oferta e admin ── --}}
            @can('delete', $oferta)
                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir esta oferta?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-dash-action delete">
                        <i class="bi bi-trash3"></i>
                        Excluir oferta
                    </button>
                </form>
            @endcan

        </div>

    </div>

</x-content>
</x-header_admin>