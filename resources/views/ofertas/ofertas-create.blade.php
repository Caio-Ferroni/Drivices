<x-header_admin pageTitle="Ofertas" breadcrumb="Nova Oferta">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pedidos.show', $pedido) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar ao pedido
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-tags"></i>
                Nova Oferta
            </div>
        </div>

        <form action="{{ route('pedidos.ofertas.store', ['pedido' => $pedido]) }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="professional_id" value="{{ auth()->user()->professional->id }}"/>

            <div class="dash-card-body">

                {{-- CONTEXTO DO PEDIDO ── --}}
                <div class="dash-show-user-row mb-4">
                    <div class="dash-td-ava dash-td-ava-lg">
                        {{ strtoupper(substr($pedido->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="dash-show-user-name">{{ $pedido->user->name }}</div>
                        <div class="dash-td-sub">Pedido #{{ $pedido->id }} · {{ Str::limit($pedido->descricao, 60) }}</div>
                    </div>
                    @if($pedido->emergencia)
                        <span class="dash-badge dash-badge-red ms-auto">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Emergência
                        </span>
                    @endif
                </div>

                <hr class="dash-divider">

                <div class="row g-4">

                    {{-- CUSTO --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('custo') has-error @enderror">
                            <label class="dash-label" for="custo">
                                Valor da oferta <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-currency-dollar dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="number"
                                    id="custo"
                                    name="custo"
                                    value="{{ old('custo') }}"
                                    placeholder="0,00"
                                    min="0"
                                    step="0.01"
                                    autocomplete="off"
                                />
                            </div>
                            @error('custo')
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
                    Enviar oferta
                </button>
            </div>

        </form>

    </div>

</x-content>
</x-header_admin>