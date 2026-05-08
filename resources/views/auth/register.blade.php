<x-auth_layout hint="Já tem conta?" hint-link-text="Entrar" hint-link-route="login">

    <div class="auth-page-wrap">

        {{-- ── PAINEL ESQUERDO ── --}}
        <div class="auth-left-panel">
            <div class="auth-left-inner">

                <div class="left-badge">
                    <div class="pulse"></div>
                    Cadastro 100% gratuito
                </div>

                <h2>Encontre o profissional<br>que você <span class="accent">precisa</span>.</h2>
                <p>Crie sua conta em minutos e tenha acesso a milhares de profissionais verificados na sua região.</p>

                <div class="auth-perks">
                    <div class="auth-perk">
                        <div class="auth-perk-icon">🔍</div>
                        <div>
                            <strong>Busca inteligente</strong>
                            <span>Filtre por categoria, avaliação e localização.</span>
                        </div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon">
                            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="var(--p4)" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <div>
                            <strong>Profissionais verificados</strong>
                            <span>Documentos e antecedentes validados.</span>
                        </div>
                    </div>
                    <div class="auth-perk">
                        <div class="auth-perk-icon">💰</div>
                        <div>
                            <strong>Pagamento protegido</strong>
                            <span>Liberado só após a conclusão do serviço.</span>
                        </div>
                    </div>
                </div>

                <div class="auth-social-proof">
                    <div class="auth-sp-avatars">
                        <div class="auth-sp-ava" style="background: linear-gradient(135deg,#5B44F2,#9E8FF6)">JP</div>
                        <div class="auth-sp-ava" style="background: linear-gradient(135deg,#F25B8E,#F2A25B)">FC</div>
                        <div class="auth-sp-ava" style="background: linear-gradient(135deg,#44C4F2,#7D6AF4)">RM</div>
                        <div class="auth-sp-ava" style="background: linear-gradient(135deg,#22C97A,#44C4F2)">BL</div>
                        <div class="auth-sp-ava auth-sp-more">+12k</div>
                    </div>
                    <div class="auth-sp-text">
                        <strong>+12.000 usuários</strong> já encontraram<br>seu profissional pela Drivices.
                    </div>
                </div>

            </div>
        </div>

        {{-- ── PAINEL DIREITO (FORMULÁRIO) ── --}}
        <div class="auth-right-panel">
            <div class="auth-form-card">

                <div class="auth-form-header">
                    <h1 class="auth-form-title">Crie sua conta</h1>
                    <p class="auth-form-sub">Preencha os dados abaixo para começar.</p>
                </div>

                <form action="{{ route('register') }}" method="POST" novalidate>
                    @csrf

                    {{-- NOME --}}
                    <div class="auth-field @error('name') has-error @enderror">
                        <label class="auth-label" for="name">
                            Nome completo <span class="auth-req">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input
                                class="auth-input"
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="João Silva"
                                required
                                autocomplete="name"
                            />
                        </div>
                        @error('name')
                            <span class="auth-field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- CPF --}}
                    <div class="auth-field @error('cpf') has-error @enderror">
                        <label class="auth-label" for="cpf">
                            CPF <span class="auth-req">*</span>
                        </label>
                        <div class="auth-input-wrap">
                            <span class="auth-input-icon">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <path d="M7 9h10M7 13h6"/>
                                </svg>
                            </span>
                            <input
                                class="auth-input"
                                type="text"
                                id="cpf"
                                name="cpf"
                                value="{{ old('cpf') }}"
                                placeholder="000.000.000-00"
                                maxlength="14"
                                required
                                autocomplete="off"
                                data-mask="cpf"
                            />
                        </div>
                        @error('cpf')
                            <span class="auth-field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

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
                        <label class="auth-label" for="password">
                            Senha <span class="auth-req">*</span>
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
                            Confirmar senha <span class="auth-req">*</span>
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
                                placeholder="Repita a senha"
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

                    {{-- CAMPOS OCULTOS --}}
                    <input type="hidden" name="nascimento" value="{{ date('Y-m-d') }}"/>
                    <input type="hidden" name="tipo" value="Usuario"/>

                    {{-- SUBMIT --}}
                    <button type="submit" class="auth-submit-btn">
                        Criar conta
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>

                </form>

                <div class="auth-signin-link">
                    Já tem uma conta? <a href="{{ route('login') }}">Entrar agora</a>
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