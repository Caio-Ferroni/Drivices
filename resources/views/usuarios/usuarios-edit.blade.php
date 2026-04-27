<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name"  placeholder="Nome">
    <input type="text" name="cpf"  placeholder="cpf">
    <input type="date" name="nascimento" placeholder="Data de Nascimento">
    <input type="email" name="email"  placeholder="E-mail">
    <input type="password" name="password"  placeholder="Senha">
    
    <button type="submit">enviar</button>
    <button type="submit">Enviar</button>
</form>

