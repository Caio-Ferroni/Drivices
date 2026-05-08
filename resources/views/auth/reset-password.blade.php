<x-auth_layout>

    <div class="auth-page-wrap auth-page-wrap-centered">

        <div class="auth-right-panel">
            <div class="auth-form-card">

                <div class="auth-form-header">
                    <h1 class="auth-form-title">Redefinir senha</h1>
                    <p class="auth-form-sub">Escolha uma nova senha para sua conta.</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST" novalidate>
                    @csrf

                    {{-- TOKEN (oculto) --}}
                    <input type="hidden" name="token" value="{{ request()->route('token') }}"/>

                    {{-- EMAIL --}}
                    <div class="auth-field @error('email') has-error @enderror">
                        <label class="auth-label" for="email">
                            E-mail <span class="auth-req">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </span>
                            <input
                                class="auth-input"
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', request()->email) }}"
                                placeholder="voce@email.com"
                                required
                                autocomplete="email"
                                autofocus
                            />
                        </div>
                        @error('email')
                            <span class="auth-field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- NOVA SENHA --}}
                    <div class="auth-field @error('password') has-error @enderror">
                        <label class="auth-label" for="password">
                            Nova senha <span class="auth-req">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                                </svg>
                            </span>
                            <input
                                class="auth-input auth-input-has-suffix"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Mín. 8 caracteres"
                                required
                                autocomplete="new-password"
                            />
                            <button type="button" class="auth-input-suffix" data-toggle-password="password" aria-label="Mostrar senha">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- CONFIRMAR SENHA --}}
                    <div class="auth-field">
                        <label class="auth-label" for="password_confirmation">
                            Confirmar nova senha <span class="auth-req">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                                </svg>
                            </span>
                            <input
                                class="auth-input auth-input-has-suffix"
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Repita a nova senha"
                                required
                                autocomplete="new-password"
                            />
                            <button type="button" class="auth-input-suffix" data-toggle-password="password_confirmation" aria-label="Mostrar confirmação">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit" class="auth-submit-btn">
                        Redefinir senha
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>

                </form>

                <div class="auth-signin-link">
                    Lembrou a senha? <a href="{{ route('login') }}">Entrar agora</a>
                </div>

                <div class="auth-footer-note">
                    Protegido por criptografia SSL &nbsp;·&nbsp;
                    <a href="#">Privacidade</a> &nbsp;·&nbsp;
                    <a href="#">Termos de uso</a>
                </div>

            </div>
        </div>

    </div>

</x-auth_layout>