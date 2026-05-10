<x-header_admin pageTitle="Serviços" breadcrumb="Gerenciamento">
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
                    <i class="bi bi-tools"></i>
                    Serviços
                </div>
                <div class="dash-card-sub">
                    @can('is_admin')
                        Listagem completa de todos os serviços da plataforma
                    @elsecan('is_professional')
                        Serviços vinculados ao seu perfil profissional
                    @else
                        Serviços relacionados aos seus pedidos
                    @endcan
                </div>
            </div>
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Profissional</th>
                        <th>Custo</th>
                        <th>Status</th>
                        <th>Confirmação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicos as $servico)
                        <tr>
                            <td>
                                <div class="dash-td-user">
                                    <div class="dash-td-ava">
                                        {{ strtoupper(substr($servico->pedido->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="dash-td-name">{{ $servico->pedido->user->name }}</div>
                                        <div class="dash-td-sub">Pedido #{{ $servico->pedido_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dash-td-user">
                                    <div class="dash-td-ava" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                                        {{ strtoupper(substr($servico->oferta->professional->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="dash-td-name">{{ $servico->oferta->professional->user->name }}</div>
                                        <div class="dash-td-sub">Oferta #{{ $servico->oferta_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="dash-td-currency">
                                    R$ {{ number_format($servico->oferta->custo, 2, ',', '.') }}
                                </span>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                @if($servico->confirmacao)
                                    <span class="dash-badge dash-badge-green">
                                        <i class="bi bi-check-circle"></i>
                                        {{ \Carbon\Carbon::parse($servico->confirmacao)->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="dash-badge dash-badge-neutral">Pendente</span>
                                @endif
                            </td>
                            <td>
                                <div class="dash-td-actions">
                                    <a href="{{ route('servicos.show', $servico->id) }}"
                                       class="dash-td-btn" title="Ver detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Concluir: admin ou profissional vinculado --}}
                                    @if(auth()->user()->can('is_admin') || (auth()->user()->can('is_professional') && auth()->user()->professional->id === $servico->idProfissional))
                                        @if($servico->status !== 'concluido')
                                            <a href="{{ route('servicos.concluir', $servico) }}"
                                               class="dash-td-btn" title="Concluir serviço"
                                               onclick="return confirm('Confirmar conclusão deste serviço?');">
                                                <i class="bi bi-check-circle"></i>
                                            </a>
                                        @endif
                                    @endif

                                    {{-- Editar e Excluir: apenas admin --}}
                                    @can('is_admin')
                                        <a href="{{ route('servicos.edit', $servico->id) }}"
                                           class="dash-td-btn" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
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
                            <td colspan="6">
                                <div class="dash-table-empty">
                                    <i class="bi bi-tools"></i>
                                    <div>Nenhum serviço encontrado</div>
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