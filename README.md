# Teste Prático CMTECH - Estágio

## Autor

Guilherme Oliveira

---

# Tecnologias Utilizadas

- PHP
- MySQL
- HTML
- Bootstrap
- XAMPP
- Java Script
- Git e GitHub

---

# Como executar o projeto

## Pré-requisitos

- PHP 8+
- MySQL
- Apache
- XAMPP (ou ambiente equivalente)

## Instalação

## 1. Clonar o repositório

```bash
git clone https://github.com/Guii-Oliveira/cmtech-desafio-estagio.git
```

## 2. Copiar o projeto para o diretório htdocs

Mover a pasta do projeto para o diretório `htdocs` do XAMPP.

## 3. Criar o banco de dados

Criar um banco MySQL utilizando o phpMyAdmin.

## 4. Importar o banco

Importar o arquivo SQL disponibilizado no projeto.

## 5. Configurar a conexão

Configurar usuário, senha e banco de dados no arquivo de conexão da aplicação.

## 6. Iniciar os serviços

Iniciar Apache e MySQL através do XAMPP.

## 7. Acessar a aplicação

```text
http://localhost/teste-php-main
```

Caso necessário:

```text
http://localhost/teste-php-main/?controller=UsuariosController&method=listar
```

Se o usuário não estiver autenticado, será redirecionado para a tela de login.

---

# Funcionalidades Implementadas

## Login

- Autenticação de usuários utilizando email e senha.
- Controle de sessão.
- Proteção de rotas para usuários não autenticados.

## CRUD de Usuários

Implementado o CRUD completo para usuários:

- Criar usuário
- Listar usuários
- Editar usuário
- Excluir usuário

Campos da tabela:

- Nome
- Email
- Senha
- Ativo
- Data de Criação
- Data de Atualização
- Limpeza automática dos campos do formulário utilizando JavaScript.

## Validações Implementadas

### Usuários

- Não permite cadastro com campos obrigatórios vazios.
- Validação de preenchimento através do atributo `required`.
- Validação adicional realizada no backend.
- Não permite cadastro de usuários com email duplicado.

### Contatos

- Mantida a validação obrigatória dos campos.
- Melhorias na consistência do processo de cadastro.

---

# Respostas às Perguntas do Desafio

## O que você faria para melhorar o CRUD de contatos?

Durante o desenvolvimento implementei algumas melhorias:

- Validação de preenchimento obrigatório dos campos.
- Utilização do atributo `required` nos formulários.
- Limpeza automática dos campos do formulário utilizando JavaScript.
- Melhoria na consistência das validações realizadas no sistema.

Além das melhorias implementadas, eu também poderia evoluir o CRUD com:

- Validação de formato de email.
- Máscara para telefone.
- Pesquisa de contatos por nome.
- Paginação da listagem.
- Exclusão lógica dos registros.
- Tratamento de exceções.
- Mensagens de feedback mais amigáveis para o usuário.
---

## Como fazer uma alteração para incluir exclusão lógica?

Uma abordagem seria adicionar um campo na tabela:

```sql
ativo TINYINT(1)
```

ou

```sql
deleted_at DATETIME NULL
```

Ao excluir um registro, em vez de removê-lo do banco:

```sql
UPDATE contatos
SET ativo = 0
WHERE id = ?
```

Assim o registro permanece armazenado para auditoria e recuperação futura.

---

## Quais padrões de projeto você identifica nesse projeto?

Padrões identificados:

### MVC (Model-View-Controller)

Separação entre:

- Models
- Views
- Controllers

### Front Controller

O arquivo principal centraliza as requisições e direciona para os controllers adequados.

### Active Record

Os Models realizam diretamente operações de consulta e persistência no banco de dados.

---

## Quais padrões de projeto poderiam ser implementados?

Algumas melhorias possíveis:

### Repository Pattern

Responsável por centralizar consultas ao banco.

### Service Layer

Separação das regras de negócio dos controllers.

### Dependency Injection

Redução de acoplamento entre classes.

### Singleton

Para gerenciamento da conexão com o banco.

### Strategy Pattern

Para diferentes regras de validação.

---

## Como incluir tratamento de exceção?

Utilizando blocos try/catch:

```php
try {
    $usuario->save();
} catch (Exception $e) {
    echo $e->getMessage();
}
```

Também poderiam ser criadas exceções personalizadas para regras específicas do sistema.

---

# Melhorias Implementadas Durante o Desafio

- Implementação do CRUD completo de usuários.
- Criptografia de senha utilizando `password_hash()`.
- Validação de email duplicado.
- Proteção de rotas através de sessão.
- Validação obrigatória dos campos do formulário de usuários.
- Ajustes na navegação e autenticação do sistema.

---

# Dificuldades Encontradas

Durante o desenvolvimento foram realizados ajustes relacionados à autenticação, controle de sessão e validação dos formulários.

As funcionalidades principais solicitadas para a etapa de estágio foram implementadas seguindo a estrutura original do projeto.

---

# Considerações Finais

O desenvolvimento foi realizado buscando manter a arquitetura original do sistema e aplicar boas práticas básicas de organização, validação e segurança, compatíveis com o escopo proposto para a vaga de estágio.