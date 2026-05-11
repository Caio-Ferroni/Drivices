<x-header_admin pageTitle="Relatórios" breadcrumb="Editar">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('relatorios.show', $relatorio->id) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-pencil-square"></i>
                Editar Relatório #{{ $relatorio->id }}
            </div>
        </div>

        <form action="{{ route('relatorios.update', $relatorio) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="dash-card-body">

                {{-- CONTEXTO DO SERVIÇO ── --}}
                <div class="dash-show-user-row">
                    <div class="dash-td-ava dash-td-ava-lg" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                        {{ strtoupper(substr($relatorio->servico->professional->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="dash-show-user-name">{{ $relatorio->servico->professional->user->name }}</div>
                        <div class="dash-td-sub">Serviço #{{ $relatorio->servico_id }} · {{ $relatorio->servico->pedido->user->name }}</div>
                    </div>
                    <a href="{{ route('servicos.show', $relatorio->servico_id) }}" class="btn-dash-action edit ms-auto">
                        <i class="bi bi-box-arrow-up-right"></i>
                        Ver serviço
                    </a>
                </div>

                <hr class="dash-divider">

                <div class="row g-4">

                    {{-- RELATORIO --}}
                    <div class="col-12">
                        <div class="dash-field @error('relatorio') has-error @enderror">
                            <label class="dash-label" for="relatorio">
                                Descrição do serviço realizado <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-file-text dash-input-icon dash-textarea-icon"></i>
                                <textarea
                                    class="dash-input dash-textarea"
                                    id="relatorio"
                                    name="relatorio"
                                    placeholder="Descreva detalhadamente o que foi feito..."
                                    rows="6"
                                >{{ old('relatorio', $relatorio->relatorio) }}</textarea>
                            </div>
                            @error('relatorio')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <div class="dash-card-footer d-flex justify-content-end gap-3">
                <a href="{{ route('relatorios.show', $relatorio->id) }}" class="btn-dash-back">
                    Cancelar
                </a>
                <button type="submit" class="btn-dash-primary">
                    <i class="bi bi-check-lg"></i>
                    Salvar alterações
                </button>
            </div>

        </form>

    </div>

</x-content>
</x-header_admin>