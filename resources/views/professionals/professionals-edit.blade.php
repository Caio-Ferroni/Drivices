<x-header_admin pageTitle="Profissionais" breadcrumb="Editar Perfil">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('professionals.show', $professional->id) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-pencil-square"></i>
                Editar Perfil Profissional
            </div>
        </div>

        <form action="{{ route('professionals.update', ['professional' => $professional]) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="dash-card-body">
                <div class="row g-4">

                    {{-- CONTEXTO DO USUÁRIO ── --}}
                    <div class="col-12">
                        <div class="dash-show-user-row">
                            <div class="dash-td-ava dash-td-ava-lg">
                                {{ strtoupper(substr($professional->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="dash-show-user-name">{{ $professional->user->name }}</div>
                                <div class="dash-td-sub">{{ $professional->user->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="dash-divider" style="margin: 0;">
                    </div>

                    {{-- BIOGRAFIA --}}
                    <div class="col-12">
                        <div class="dash-field @error('biografia') has-error @enderror">
                            <label class="dash-label" for="biografia">Biografia</label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-person-lines-fill dash-input-icon dash-textarea-icon"></i>
                                <textarea
                                    class="dash-input dash-textarea"
                                    id="biografia"
                                    name="biografia"
                                    placeholder="Descreva sua experiência, especialidades e diferenciais..."
                                    rows="5"
                                >{{ old('biografia', $professional->biografia) }}</textarea>
                            </div>
                            @error('biografia')
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
                <a href="{{ route('professionals.show', $professional->id) }}" class="btn-dash-back">
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