<x-header_admin pageTitle="Endereços" breadcrumb="Gerenciamento">
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
                    <i class="bi bi-geo-alt"></i>
                    Endereços cadastrados
                </div>
                <div class="dash-card-sub">Listagem completa de todos os endereços da plataforma</div>
            </div>
        </div>

        <div class="dash-table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>CEP</th>
                        <th>Logradouro</th>
                        <th>Unidade</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Região</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enderecos as $endereco)
                        <tr>
                            <td>
                                <div class="dash-td-user">
                                    <div class="dash-td-ava">
                                        {{ strtoupper(substr($endereco->user->name ?? '??', 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="dash-td-name">{{ $endereco->user->name ?? '—' }}</div>
                                        <div class="dash-td-sub">#{{ $endereco->user->id ?? '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><code class="dash-code">{{ $endereco->cep }}</code></td>
                            <td>{{ $endereco->logradouro }}</td>
                            <td>{{ $endereco->unidade ?? '—' }}</td>
                            <td>{{ $endereco->complemento ?? '—' }}</td>
                            <td>{{ $endereco->bairro }}</td>
                            <td>{{ $endereco->localidade }}</td>
                            <td>{{ $endereco->uf }}</td>
                            <td>{{ $endereco->regiao }}</td>
                            <td>
                                <div class="dash-td-actions">
                                    <a href="{{ route('enderecos.show', $endereco->id) }}" class="dash-td-btn" title="Ver detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('enderecos.edit', $endereco->id) }}" class="dash-td-btn" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dash-td-btn danger" title="Excluir">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="dash-table-empty">
                                    <i class="bi bi-geo-alt"></i>
                                    <div>Nenhum endereço cadastrado</div>
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