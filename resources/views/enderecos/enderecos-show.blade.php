<x-header_admin pageTitle="Endereços" breadcrumb="Detalhes">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('enderecos.index') }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-geo-alt"></i>
                Endereço
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('enderecos.edit', $endereco->id) }}" class="btn-dash-action edit">
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>
            </div>
        </div>

        <div class="dash-card-body">

            {{-- USUÁRIO VINCULADO ── --}}
            <div class="dash-show-user-row">
                <div class="dash-td-ava dash-td-ava-lg">
                    {{ strtoupper(substr($endereco->user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="dash-show-user-name">{{ $endereco->user->name }}</div>
                    <div class="dash-td-sub">Proprietário deste endereço</div>
                </div>
                <a href="{{ route('users.show', $endereco->user->id) }}" class="btn-dash-action edit ms-auto">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Ver perfil
                </a>
            </div>

            <hr class="dash-divider">

            {{-- CAMPOS ── --}}
            <div class="row g-4">

                <div class="col-md-3">
                    <div class="dash-show-field">
                        <div class="detail-label">CEP</div>
                        <div class="detail-value">
                            <code class="dash-code">{{ $endereco->cep }}</code>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Logradouro</div>
                        <div class="detail-value">{{ $endereco->logradouro }}</div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dash-show-field">
                        <div class="detail-label">Unidade</div>
                        <div class="detail-value">{{ $endereco->unidade ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Complemento</div>
                        <div class="detail-value">{{ $endereco->complemento ?? '—' }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dash-show-field">
                        <div class="detail-label">Bairro</div>
                        <div class="detail-value">{{ $endereco->bairro }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dash-show-field">
                        <div class="detail-label">Cidade</div>
                        <div class="detail-value">{{ $endereco->localidade }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dash-show-field">
                        <div class="detail-label">UF</div>
                        <div class="detail-value">{{ $endereco->uf }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dash-show-field">
                        <div class="detail-label">Região</div>
                        <div class="detail-value">{{ $endereco->regiao }}</div>
                    </div>
                </div>

            </div>

        </div>

        <div class="dash-card-footer">
            <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST"
                  onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-dash-action delete">
                    <i class="bi bi-trash3"></i>
                    Excluir endereço
                </button>
            </form>
        </div>

    </div>

</x-content>
</x-header_admin>