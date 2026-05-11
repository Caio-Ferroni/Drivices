<x-header_admin pageTitle="Relatórios" breadcrumb="Novo Relatório">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('servicos.show', $servico->id) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar ao serviço
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-file-earmark-plus"></i>
                Novo Relatório
            </div>
        </div>

        <form action="{{ route('servicos.relatorios.store', $servico) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <input type="hidden" name="servico_id" value="{{ $servico->id }}"/>
            <input type="hidden" name="status"     value="{{ $servico->status }}"/>

            <div class="dash-card-body">

                {{-- CONTEXTO DO SERVIÇO ── --}}
                <div class="dash-show-user-row">
                    <div class="dash-td-ava dash-td-ava-lg" style="background: linear-gradient(135deg, var(--p2), var(--p3))">
                        {{ strtoupper(substr($servico->professional->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="dash-show-user-name">{{ $servico->professional->user->name }}</div>
                        <div class="dash-td-sub">Serviço #{{ $servico->id }} · {{ $servico->user->name }}</div>
                    </div>
                    @php
                        $statusMap = [
                            'em_andamento' => 'dash-badge-blue',
                            'concluido'    => 'dash-badge-green',
                            'cancelado'    => 'dash-badge-red',
                            'pendente'     => 'dash-badge-amber',
                        ];
                        $badgeClass = $statusMap[$servico->status] ?? 'dash-badge-neutral';
                    @endphp
                    <span class="dash-badge {{ $badgeClass }} ms-auto">
                        {{ ucfirst(str_replace('_', ' ', $servico->status ?? '—')) }}
                    </span>
                </div>

                <hr class="dash-divider">

                <div class="row g-4">

                    {{-- RELATÓRIO --}}
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
                                >{{ old('relatorio') }}</textarea>
                            </div>
                            @error('relatorio')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- FOTO --}}
                    <div class="col-12">
                        <div class="dash-field @error('foto') has-error @enderror">
                            <label class="dash-label" for="foto">
                                Foto do serviço concluído
                                <span class="dash-label-hint">(opcional)</span>
                            </label>
                            <div class="dash-file-wrap">
                                <label class="dash-file-label" for="foto">
                                    <i class="bi bi-upload"></i>
                                    <span id="foto-label-text">Clique para selecionar uma imagem</span>
                                </label>
                                <input
                                    class="dash-file-input"
                                    type="file"
                                    id="foto"
                                    name="foto"
                                    accept="image/*"
                                />
                            </div>
                            @error('foto')
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
                <a href="{{ route('servicos.show', $servico->id) }}" class="btn-dash-back">
                    Cancelar
                </a>
                <button type="submit" class="btn-dash-primary">
                    <i class="bi bi-check-lg"></i>
                    Enviar relatório
                </button>
            </div>

        </form>

    </div>

</x-content>
</x-header_admin>

@push('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function () {
        var label = document.getElementById('foto-label-text');
        label.textContent = this.files.length > 0
            ? this.files[0].name
            : 'Clique para selecionar uma imagem';
    });
</script>
@endpush