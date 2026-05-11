<x-header_admin pageTitle="Ofertas" breadcrumb="Listagem">
<x-content>

    @if(session('success'))
        <div class="dash-alert dash-alert-success">
            <i class="bi bi-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pedidos.show', $pedido) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar ao pedido
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div>
                <div class="dash-card-title">
                    <i class="bi bi-tags"></i>
                    Ofertas do Pedido #{{ $pedido->id }}
                </div>
                <div class="dash-card-sub">
                    {{ Str::limit($pedido->descricao, 80) }}
                </div>
            </div>
            @can('is_professional')
                <a href="{{ route('pedidos.ofertas.create', $pedido) }}" class="btn-dash-primary">
                    <i class="bi bi-plus-lg"></i>
                    Fazer Oferta
                </a>
            @endcan
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Profissional</th>
                        <th>Custo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ofertas as $oferta)
                        <tr>
                            <td>
                                <div class="dash-td-user">
                                    <div class="dash-td-ava" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                                        {{ strtoupper(substr($oferta->professional->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="dash-td-name">{{ $oferta->professional->user->name }}</div>
                                        <div class="dash-td-sub">Oferta #{{ $oferta->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="dash-td-currency">
                                    R$ {{ number_format($oferta->custo, 2, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <div class="dash-td-actions">
                                    <a href="{{ route('ofertas.show', $oferta->id) }}"
                                       class="dash-td-btn" title="Ver detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @can('update', $oferta)
                                        <a href="{{ route('ofertas.edit', $oferta->id) }}"
                                           class="dash-td-btn" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete', $oferta)
                                        <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta oferta?');">
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
                                    <i class="bi bi-tags"></i>
                                    @if (auth()->user()->id != $pedido->user_id && !auth()->user()->isAdmin())
                                    <div>Você não fez nenhuma oferta para este pedido</div>
                                        @else
                                        <div>Nenhuma oferta encontrada para este pedido</div>
                                    @endif
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