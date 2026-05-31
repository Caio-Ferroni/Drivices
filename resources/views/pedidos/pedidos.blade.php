<x-header_admin pageTitle="Pedidos" breadcrumb="Gerenciamento">
<x-content>

    @if(session('success'))
        <div class="dash-alert dash-alert-success">
            <i class="bi bi-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
     @if(session('error'))
        <div class="dash-alert dash-alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="dash-card">

        <div class="dash-card-header">
            <div>
                <div class="dash-card-title">
                    <i class="bi bi-clipboard-text"></i>
                    @can('is_professional')
                        Pedidos Disponíveis
                    @else
                        @can('is_admin')
                            Pedidos
                        @else
                            Meus Pedidos
                        @endcan
                    @endcan
                </div>
                <div class="dash-card-sub">
                    @can('is_admin')
                        Listagem completa de todos os pedidos da plataforma
                    @else
                        Pedidos relacionados à sua conta
                    @endcan
                </div>
            </div>
            @cannot('is_professional')
                <a href="{{ route('pedidos.create') }}" class="btn-dash-primary">
                    <i class="bi bi-plus-lg"></i>
                    Fazer Pedido
                </a>
            @endcannot
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Descrição</th>
                        <th>Emergência</th>
                        <th>Disponibilidade</th>
                        <th>Data Preferida</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos as $pedido)
                        @can('view', $pedido)
                            <tr>
                                <td>
                                    <div class="dash-td-user">
                                        <div class="dash-td-ava">
                                            {{ strtoupper(substr($pedido->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="dash-td-name">{{ $pedido->user->name }}</div>
                                            <div class="dash-td-sub">#{{ $pedido->user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dash-td-truncate" title="{{ $pedido->descricao }}">
                                        {{ Str::limit($pedido->descricao, 50) }}
                                    </div>
                                </td>
                                <td>
                                    @if($pedido->emergencia)
                                        <span class="dash-badge dash-badge-red">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            &nbsp Emergência
                                        </span>
                                    @else
                                        <span class="dash-badge dash-badge-neutral">Normal</span>
                                    @endif
                                </td>
                                <td>{{ $pedido->disponibilidade ?? '—' }}</td>
                                <td>
                                    {{ $pedido->data_preferida
                                        ? \Carbon\Carbon::parse($pedido->data_preferida)->format('d/m/Y')
                                        : '—' }}
                                </td>
                                <td>
                                    @php
                                        $statusMap = [
                                            'aberto'     => 'dash-badge-green',
                                            'em_andamento' => 'dash-badge-blue',
                                            'concluido'  => 'dash-badge-neutral',
                                            'cancelado'  => 'dash-badge-red',
                                        ];
                                        $badgeClass = $statusMap[$pedido->status] ?? 'dash-badge-neutral';
                                    @endphp
                                    <span class="dash-badge {{ $badgeClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $pedido->status ?? '—')) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dash-td-actions">
                                        <a href="{{ route('pedidos.show', $pedido) }}"
                                           class="dash-td-btn" title="Ver detalhes">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        {{-- @if ($pedido->user_id === auth()->user()->id) --}}
                                            <a href="{{ route('pedidos.ofertas.index', $pedido) }}"
                                           class="dash-td-btn" title="Ver ofertas">
                                            <i class="bi bi-tags"></i>
                                        </a>
                                        {{-- @endif --}}
                                        @can('update', $pedido)
                                            <a href="{{ route('pedidos.edit', $pedido) }}"
                                               class="dash-td-btn" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $pedido)
                                            <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir este pedido?');">
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
                        @endcan
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="dash-table-empty">
                                    <i class="bi bi-clipboard-text"></i>
                                    <div>Nenhum pedido encontrado</div>
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