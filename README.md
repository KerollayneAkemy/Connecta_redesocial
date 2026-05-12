# Rede Social - Sistema de Autenticação

Este projeto é uma implementação de um sistema de autenticação completo usando **Sessions e Filters** no CodeIgniter 4, atendendo aos requisitos de um projeto acadêmico/base, mas com uma **interface premium de alto nível (Dark Mode Glassmorphism)**.

## Requisitos Implementados

1. **Cadastro de usuário**: Nome, e-mail, senha (min 6 chars), confirmar senha, hash de senha (`password_hash`).
2. **Login**: E-mail e senha com mensagens de erro, redirecionamento para o feed.
3. **Logout**: Destruição da sessão e redirecionamento para login.
4. **Proteção de Rotas (AuthFilter)**: Protege as rotas `/dashboard`, `/feed`, `/perfil`, `/post/create`, e `/post/edit`. Usuários não logados são redirecionados para `/login`.
5. **Mensagens Flash**: Exibe "Bem-vindo, [nome]" no login e "Você saiu da sua conta" no logout.
6. **Interface Premium**: Design de ponta usando Glassmorphism, animações dinâmicas e paleta de cores moderna.

## Como Testar

Siga os passos abaixo para testar a aplicação em seu ambiente local (Laragon ou php spark serve):

### 1. Inicie o Servidor

Se estiver usando o Laragon, certifique-se de que o Apache e o MySQL estão rodando. Acesse pelo virtual host (ex: `http://rede-social.test`).

Se preferir usar o servidor embutido do PHP, abra o terminal na pasta raiz do projeto e rode:
```bash
php spark serve
```
Acesse no navegador: `http://localhost:8080`

### 2. Fluxo de Teste

1. **Acesso bloqueado**: Tente acessar `http://localhost:8080/feed`. Você será automaticamente redirecionado para a tela de Login com a mensagem "Faça login primeiro."
2. **Cadastro**: Clique em "Cadastre-se" na tela de login. Preencha seus dados (garanta que a senha tem 6+ caracteres e coincide na confirmação). Ao enviar, você deve ser redirecionado para o Login com a mensagem de sucesso.
3. **Login com erro**: Tente logar com e-mail ou senha incorretos. Você verá a mensagem "Credenciais inválidas."
4. **Login com sucesso**: Faça login com a conta recém-criada. Você será redirecionado para o Feed e verá a notificação "Bem-vindo, [Seu Nome]".
5. **Navegação Protegida**: Agora você pode navegar no Feed, postar, e acessar rotas como `/dashboard` e `/perfil` livremente.
6. **Logout**: Clique no botão "Sair" no canto superior direito. Você voltará ao Login com a mensagem "Você saiu da sua conta."

## Tecnologias Utilizadas
- CodeIgniter 4
- PHP 8.1+
- Vanilla CSS 3 (Glassmorphism UI)
- MySQL
