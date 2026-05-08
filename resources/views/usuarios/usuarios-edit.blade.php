<x-header_admin pageTitle="Usuários" breadcrumb="Editar">
    <x-content>

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('users.show', $user->id) }}" class="btn-dash-back">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </div>

        <div class="dash-card">

            <div class="dash-card-header">
                <div class="dash-card-title">
                    <i class="bi bi-pencil-square"></i>
                    Editar Usuário
                </div>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="dash-card-body">
                    <div class="row g-4">

                        {{-- NOME --}}
                        <div class="col-md-6">
                            <div class="dash-field @error('name') has-error @enderror">
                                <label class="dash-label" for="name">Nome completo</label>
                                <div class="dash-input-wrap">
                                    <i class="bi bi-person dash-input-icon"></i>
                                    <input
                                        class="dash-input"
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="Nome completo"
                                        autocomplete="name"
                                    />
                                </div>
                                @error('name')
                                    <span class="dash-field-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- CPF --}}
                        <div class="col-md-6">
                            <div class="dash-field @error('cpf') has-error @enderror">
                                <label class="dash-label" for="cpf">CPF</label>
                                <div class="dash-input-wrap">
                                    <i class="bi bi-card-text dash-input-icon"></i>
                                    <input
                                        class="dash-input"
                                        type="text"
                                        id="cpf"
                                        name="cpf"
                                        value="{{ old('cpf', $user->cpf) }}"
                                        placeholder="000.000.000-00"
                                        maxlength="14"
                                        autocomplete="off"
                                        data-mask="cpf"
                                    />
                                </div>
                                @error('cpf')
                                    <span class="dash-field-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- NASCIMENTO --}}
                        <div class="col-md-6">
                            <div class="dash-field @error('nascimento') has-error @enderror">
                                <label class="dash-label" for="nascimento">Data de Nascimento</label>
                                <div class="dash-input-wrap">
                                    <i class="bi bi-calendar3 dash-input-icon"></i>
                                    <input
                                        class="dash-input"
                                        type="date"
                                        id="nascimento"
                                        name="nascimento"
                                        value="{{ old('nascimento', \Carbon\Carbon::parse($user->nascimento)->format('Y-m-d')) }}"
                                    />
                                </div>
                                @error('nascimento')
                                    <span class="dash-field-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <div class="dash-field @error('email') has-error @enderror">
                                <label class="dash-label" for="email">E-mail</label>
                                <div class="dash-input-wrap">
                                    <i class="bi bi-envelope dash-input-icon"></i>
                                    <input
                                        class="dash-input"
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="voce@email.com"
                                        autocomplete="email"
                                    />
                                </div>
                                @error('email')
                                    <span class="dash-field-error">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- SENHA --}}
                        <div class="col-md-6">
                            <div class="dash-field @error('password') has-error @enderror">
                                <label class="dash-label" for="password">
                                    Nova senha
                                    <span class="dash-label-hint">(deixe em branco para manter a atual)</span>
                                </label>
                                <div class="dash-input-wrap">
                                    <i class="bi bi-lock dash-input-icon"></i>
                                    <input
                                        class="dash-input dash-input-has-suffix"
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="••••••••"
                                        autocomplete="new-password"
                                    />
                                    <button type="button" class="dash-input-suffix" data-toggle-password="password" aria-label="Mostrar senha">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
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
                    <a href="{{ route('users.show', $user->id) }}" class="btn-dash-back">
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