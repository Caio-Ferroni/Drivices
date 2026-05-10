<x-header_admin pageTitle="Endereços" breadcrumb="Novo Endereço">
<x-content>

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('users.show', auth()->id()) }}" class="btn-dash-back">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    </div>

    <div class="dash-card">

        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="bi bi-geo-alt"></i>
                Novo Endereço
            </div>
        </div>

        <form action="{{ route('enderecos.store') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>

            <div class="dash-card-body">
                <div class="row g-4">

                    {{-- CEP --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('cep') has-error @enderror">
                            <label class="dash-label" for="cep">
                                CEP <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-mailbox dash-input-icon"></i>
                                <input
                                    class="dash-input dash-input-has-suffix"
                                    type="text"
                                    id="cep"
                                    name="cep"
                                    value="{{ old('cep') }}"
                                    placeholder="00000-000"
                                    maxlength="9"
                                    autocomplete="off"
                                    data-mask="cep"
                                />
                                <span class="dash-input-suffix" id="cep-spinner" style="display:none;">
                                    <span class="dash-cep-spinner"></span>
                                </span>
                            </div>
                            <span class="dash-field-hint" id="cep-hint">
                                Digite o CEP para preencher os campos automaticamente.
                            </span>
                            @error('cep')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- LOGRADOURO --}}
                    <div class="col-md-8">
                        <div class="dash-field @error('logradouro') has-error @enderror">
                            <label class="dash-label" for="logradouro">
                                Logradouro <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-signpost dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="logradouro"
                                    name="logradouro"
                                    value="{{ old('logradouro') }}"
                                    placeholder="Rua, Avenida..."
                                    autocomplete="off"
                                />
                            </div>
                            @error('logradouro')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- UNIDADE --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('unidade') has-error @enderror">
                            <label class="dash-label" for="unidade">
                                Unidade / Número
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-hash dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="unidade"
                                    name="unidade"
                                    value="{{ old('unidade') }}"
                                    placeholder="Ex: 42, Apto 3"
                                    autocomplete="off"
                                />
                            </div>
                            @error('unidade')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- COMPLEMENTO --}}
                    <div class="col-md-8">
                        <div class="dash-field @error('complemento') has-error @enderror">
                            <label class="dash-label" for="complemento">
                                Complemento
                                <span class="dash-label-hint">(opcional)</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-building dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="complemento"
                                    name="complemento"
                                    value="{{ old('complemento') }}"
                                    placeholder="Bloco, andar, sala..."
                                    autocomplete="off"
                                />
                            </div>
                            @error('complemento')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- BAIRRO --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('bairro') has-error @enderror">
                            <label class="dash-label" for="bairro">
                                Bairro <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-map dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="bairro"
                                    name="bairro"
                                    value="{{ old('bairro') }}"
                                    placeholder="Bairro"
                                    autocomplete="off"
                                />
                            </div>
                            @error('bairro')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- CIDADE --}}
                    <div class="col-md-4">
                        <div class="dash-field @error('localidade') has-error @enderror">
                            <label class="dash-label" for="localidade">
                                Cidade <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-geo dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="localidade"
                                    name="localidade"
                                    value="{{ old('localidade') }}"
                                    placeholder="Cidade"
                                    autocomplete="off"
                                />
                            </div>
                            @error('localidade')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- UF --}}
                    <div class="col-md-2">
                        <div class="dash-field @error('uf') has-error @enderror">
                            <label class="dash-label" for="uf">
                                UF <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-flag dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="uf"
                                    name="uf"
                                    value="{{ old('uf') }}"
                                    placeholder="SP"
                                    maxlength="2"
                                    autocomplete="off"
                                />
                            </div>
                            @error('uf')
                                <span class="dash-field-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- REGIÃO --}}
                    <div class="col-md-2">
                        <div class="dash-field @error('regiao') has-error @enderror">
                            <label class="dash-label" for="regiao">
                                Região <span class="auth-req">*</span>
                            </label>
                            <div class="dash-input-wrap">
                                <i class="bi bi-compass dash-input-icon"></i>
                                <input
                                    class="dash-input"
                                    type="text"
                                    id="regiao"
                                    name="regiao"
                                    value="{{ old('regiao') }}"
                                    placeholder="Sudeste"
                                    autocomplete="off"
                                />
                            </div>
                            @error('regiao')
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
                <a href="{{ route('users.show', auth()->id()) }}" class="btn-dash-back">
                    Cancelar
                </a>
                <button type="submit" class="btn-dash-primary">
                    <i class="bi bi-check-lg"></i>
                    Salvar endereço
                </button>
            </div>

        </form>

    </div>

</x-content>
</x-header_admin>