<x-auth_layout hint="Não tem conta?" hint-link-text="Cadastre-se" hint-link-route="register">

    <div class="auth-page-wrap auth-page-wrap-centered">

        <div class="auth-right-panel">
            <div class="auth-form-card">

                <div class="auth-form-header">
                    <h1 class="auth-form-title">Bem-vindo de volta</h1>
                    <p class="auth-form-sub">Entre com seus dados para acessar sua conta.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

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
                                value="{{ old('email') }}"
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

                    {{-- SENHA --}}
                    <div class="auth-field @error('password') has-error @enderror">
                        <div class="auth-label-row">
                            <label class="auth-label" for="password">
                                Senha <span class="auth-req">*</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="auth-forgot-link">Esqueceu a senha?</a>
                        </div>
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
                                placeholder="Sua senha"
                                required
                                autocomplete="current-password"
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

                    {{-- SUBMIT --}}
                    <button type="submit" class="auth-submit-btn">
                        Entrar
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>

                </form>

                <div class="auth-signin-link">
                    Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se grátis</a>
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