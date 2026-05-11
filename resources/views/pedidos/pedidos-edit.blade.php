<x-header_admin pageTitle="Pedidos" breadcrumb="Editar">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pedidos.show', $pedido) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-pencil-square"></i>
                Editar Pedido #{{ $pedido->id }}
            </div>
        </div>

        <form action="{{ route('pedidos.update', $pedido) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="dash-card-body">
                <div class="row g-4">

                    {{-- DESCRIÇÃO --}}
                    <div class="col-12">
                        <div class="dash-field @error('descricao') has-error @enderror">
                            <label class="dash-label" for="descricao">
                                Descrição do serviço <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-card-text dash-input-icon dash-textarea-icon"></i>
                                <textarea
                                    class="dash-input dash-textarea"
                                    id="descricao"
                                    name="descricao"
                                    placeholder="Descreva o serviço que você precisa..."
                                    rows="4"
                                >{{ old('descricao', $pedido->descricao) }}</textarea>
                            </div>
                            @error('descricao')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- ORÇAMENTO --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('orcamento') has-error @enderror">
                            <label class="dash-label" for="orcamento">
                                Orçamento estimado <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-currency-dollar dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="number"
                                    id="orcamento"
                                    name="orcamento"
                                    value="{{ old('orcamento', $pedido->orcamento) }}"
                                    placeholder="0,00"
                                    min="0"
                                    step="0.01"
                                    autocomplete="off"
                                />
                            </div>
                            @error('orcamento')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- DATA PREFERIDA --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('data_preferida') has-error @enderror">
                            <label class="dash-label" for="data_preferida">
                                Data preferida <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-calendar3 dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="date"
                                    id="data_preferida"
                                    name="data_preferida"
                                    value="{{ old('data_preferida', \Carbon\Carbon::parse($pedido->data_preferencia)->format('Y-m-d')) }}"
                                />
                            </div>
                            @error('data_preferida')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- DISPONIBILIDADE --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('disponibilidade') has-error @enderror">
                            <label class="dash-label" for="disponibilidade">
                                Horário preferido <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-clock dash-input-icon"></i>
                                <select class="dash-input dash-select" id="disponibilidade" name="disponibilidade">
                                    <option value="Manha" {{ old('disponibilidade', $pedido->disponibilidade) === 'Manha' ? 'selected' : '' }}>Manhã</option>
                                    <option value="Tarde" {{ old('disponibilidade', $pedido->disponibilidade) === 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                    <option value="Noite" {{ old('disponibilidade', $pedido->disponibilidade) === 'Noite' ? 'selected' : '' }}>Noite</option>
                                </select>
                            </div>
                            @error('disponibilidade')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- EMERGÊNCIA --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('emergencia') has-error @enderror">
                            <label class="dash-label" for="emergencia">
                                Emergência? <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-exclamation-triangle dash-input-icon"></i>
                                <select class="dash-input dash-select" id="emergencia" name="emergencia">
                                    <option value="0" {{ old('emergencia', $pedido->emergencia) == '0' ? 'selected' : '' }}>Não</option>
                                    <option value="1" {{ old('emergencia', $pedido->emergencia) == '1' ? 'selected' : '' }}>Sim</option>
                                </select>
                            </div>
                            @error('emergencia')
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
                <a href="{{ route('pedidos.show', $pedido) }}" class="btn-dash-back">
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