<x-header_admin pageTitle="Usuários" breadcrumb="Detalhes">
    <x-content>

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('users.index') }}" class="btn-dash-back">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="row g-4">

            {{-- ── CARD: PERFIL ── --}}
            <div class="col-12">
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="bi bi-person-circle"></i>
                            Perfil
                        </div>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn-dash-action edit">
                            <i class="bi bi-pencil"></i>
                            Editar
                        </a>
                    </div>
                    <div class="dash-card-body">
                        <div class="detail-grid">

                            <div class="detail-item">
                                <div class="detail-label">Nome</div>
                                <div class="detail-value">{{ $user->name }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">E-mail</div>
                                <div class="detail-value">{{ $user->email }}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">CPF</div>
                                <div class="detail-value">
                                    <code class="dash-code">{{ $user->cpf }}</code>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Nascimento</div>
                                <div class="detail-value">
                                    {{ \Carbon\Carbon::parse($user->nascimento)->format('d/m/Y') }}
                                </div>
                            </div>

                        </div>
                    </div>

                    @can('delete', $user)
                        <div class="dash-card-footer">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-dash-action delete">
                                    <i class="bi bi-trash3"></i>
                                    Excluir usuário
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- ── CARD: ENDEREÇO ── --}}
            <div class="col-12">
                @if($user->hasEndereco())
                    <div class="dash-card">
                        <div class="dash-card-header">
                            <div class="dash-card-title">
                                <i class="bi bi-geo-alt"></i>
                                Endereço
                            </div>
                        </div>
                        <div class="dash-card-body">
                            <div class="detail-grid">

                                <div class="detail-item">
                                    <div class="detail-label">CEP</div>
                                    <div class="detail-value">
                                        <code class="dash-code">{{ $user->endereco->cep }}</code>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Logradouro</div>
                                    <div class="detail-value">{{ $user->endereco->logradouro }}</div>
                                </div>

                                @if($user->endereco->complemento)
                                    <div class="detail-item">
                                        <div class="detail-label">Complemento</div>
                                        <div class="detail-value">{{ $user->endereco->complemento }}</div>
                                    </div>
                                @endif

                                @if($user->endereco->unidade)
                                    <div class="detail-item">
                                        <div class="detail-label">Unidade</div>
                                        <div class="detail-value">{{ $user->endereco->unidade }}</div>
                                    </div>
                                @endif

                                <div class="detail-item">
                                    <div class="detail-label">Bairro</div>
                                    <div class="detail-value">{{ $user->endereco->bairro }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Cidade</div>
                                    <div class="detail-value">{{ $user->endereco->localidade }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">UF</div>
                                    <div class="detail-value">{{ $user->endereco->uf }}</div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-label">Região</div>
                                    <div class="detail-value">{{ $user->endereco->regiao }}</div>
                                </div>

                            </div>
                        </div>
                    </div>

                @else
                    <div class="dash-card dash-card-empty">
                        <div class="dash-card-body text-center">
                            <i class="bi bi-geo-alt dash-empty-icon"></i>
                            <div class="dash-empty-title">Nenhum endereço cadastrado</div>
                            <div class="dash-empty-sub">Cadastre um endereço para poder realizar pedidos.</div>
                            <a href="{{ route('enderecos.create') }}" class="btn-dash-primary mt-3">
                                <i class="bi bi-plus-lg"></i>
                                Registrar Endereço
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ── CARD: PERFIL PROFISSIONAL ── --}}
            @if($user->isProfessional())
                <div class="col-12">
                    <div class="dash-card">
                        <div class="dash-card-header">
                            <div class="dash-card-title">
                                <i class="bi bi-briefcase"></i>
                                Perfil Profissional
                            </div>
                            <a href="{{ route('professionals.show', $user->professional->id) }}" class="btn-dash-action edit">
                                <i class="bi bi-box-arrow-up-right"></i>
                                Ver perfil completo
                            </a>
                        </div>
                        <div class="dash-card-body">
                            <div class="detail-grid">

                                <div class="detail-item detail-item-full">
                                    <div class="detail-label">Biografia</div>
                                    <div class="detail-value">{{ $user->professional->biografia ?? '—' }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>{{-- /row --}}

    </x-content>
</x-header_admin>