<x-auth_layout hint="Já tem conta?" hint-link-text="Entrar" hint-link-route="login">

    <div class="auth-page-wrap auth-page-wrap-centered">

        <div class="auth-right-panel">
            <div class="auth-form-card">

                <div class="auth-form-header">
                    <h1 class="auth-form-title">Recuperar senha</h1>
                    <p class="auth-form-sub">Digite seu e-mail para receber um link de redefinição de senha.</p>
                </div>

                @if (session('status'))
                    <div class="auth-alert auth-alert-success">
                        <div class="auth-alert-icon">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <div class="auth-alert-content">
                            <strong class="auth-alert-title">Link enviado!</strong>
                            <p class="auth-alert-message">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" novalidate>
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

                    {{-- SUBMIT --}}
                    <button type="submit" class="auth-submit-btn">
                        Enviar link
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>

                </form>

                <div class="auth-signin-link">
                    Lembrou a senha? <a href="{{ route('login') }}">Faça login</a>
                </div>

            </div>
        </div>

    </div>

</x-auth_layout>