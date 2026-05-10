<x-header_admin pageTitle="Relatórios" breadcrumb="Gerenciamento">
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
                    <i class="bi bi-file-earmark-text"></i>
                    Relatórios
                </div>
                <div class="dash-card-sub">
                    @can('is_admin')
                        Listagem completa de todos os relatórios da plataforma
                    @elsecan('is_professional')
                        Relatórios dos serviços que você executou
                    @else
                        Relatórios dos seus serviços concluídos
                    @endcan
                </div>
            </div>
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Serviço</th>
                        <th>Relatório</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($relatorios as $relatorio)
                        <tr>
                            <td>
                                <code class="dash-code">#{{ $relatorio->id }}</code>
                            </td>
                            <td>
                                <div class="dash-td-name">Serviço #{{ $relatorio->servico_id }}</div>
                            </td>
                            <td>
                                <div class="dash-td-truncate" title="{{ $relatorio->relatorio }}">
                                    {{ Str::limit($relatorio->relatorio, 60) ?? '—' }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusMap = [
                                        'pendente'   => 'dash-badge-amber',
                                        'aprovado'   => 'dash-badge-green',
                                        'reprovado'  => 'dash-badge-red',
                                        'concluido'  => 'dash-badge-neutral',
                                    ];
                                    $badgeClass = $statusMap[$relatorio->status] ?? 'dash-badge-neutral';
                                @endphp
                                <span class="dash-badge {{ $badgeClass }}">
                                    {{ ucfirst($relatorio->status ?? '—') }}
                                </span>
                            </td>
                            <td>
                                <div class="dash-td-actions">
                                    <a href="{{ route('relatorios.show', $relatorio->id) }}"
                                       class="dash-td-btn" title="Ver relatório">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @can('is_admin')
                                        <a href="{{ route('relatorios.edit', $relatorio->id) }}"
                                           class="dash-td-btn" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('relatorios.destroy', $relatorio->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este relatório?');">
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
                                    <i class="bi bi-file-earmark-text"></i>
                                    <div>Nenhum relatório encontrado</div>
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