## 🚀 Sobre o projeto
Em Breve ...

## ⚙️ Configurando do projeto

Este guia irá lhe ajudar na configuração do projeto localmente. Siga os passos abaixo para começar:

### Passo 1: Copiar os arquivos de ambiente
Copie os arquivos `.env.example` e `.env.testing.example`.

```bash
cp .env.example .env && cp .env.testing.example .env.testing
```

### Passo 2: Adicionar as variáveis de ambiente
Adicione as variáveis de ambiente `WWWUSER` e `WWWGROUP` em um dos seguintes arquivos:
* bashrc
* zshrc
* bash_profile

Você conseguirá adicionar as variáveis em questão incluindo as linhas a seguir ao arquivo escolhido:

```bash
export WWWUSER=$(id -u)
export WWWGROUP=$(id -g)
```

Depois de salvar e fechar o arquivo precisará fazer um refresh nele com o seguinte comando:
```bash
source ~/.{bashrc, zshrc, bash_profile}
```

### Passo 3: Instale o composer
Execute o comando abaixo para iniciar o processo de instalação de todas as dependencias:

```bash
docker compose run composer install --ignore-platform-reqs
```

### Passo 4: Suba os containers do projeto
O projeto utiliza o [Laravel Sail](https://laravel.com/docs/10.x/sail), uma interface de linha de comando para interagir com o ambiente de desenvolvimento Docker padrão do Laravel.

Execute o comando abaixo para subir os containers do projeto:

```bash
vendor/bin/sail up -d app
```

**DICA**: Caso ainda não possua, é possível configurar um *shell alias* para facilmente executar os comandos do Sail. Para isso, adicione as seguintes linhas em algum de seus arquivos de configuração shell (`~/.bashrc`, `~/.zshrc`, ou `~/.bash_profile`):

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Com isso você podera levantar os container ou rodar qualquer comando usando somente o `sail`:

```bash
sail up -d app
```

## Passo 4: Gerar as chaves para os arquivos de ambiente
Execute o comando para gerar as chaves para os arquivos `.env` e `.env.testing`:

```bash
sail artisan key:generate && sail artisan key:generate --env=testing
```

## ▶️ Executando os testes
A aplicação possui dois níveis de testes: **unit** e **feature**. Foram criadas dois tipos de suit de testes, sendo elas:

- Formata todo o código seguindo o padrão configurado no [Pint](https://laravel.com/docs/10.x/pint#main-content), seguindo da execução dos testes.

```bash
sail composer test
```

- Executa somente os testes.

```bash
sail composer test:only
```

## 📝 Comandos uteis
Em Breve ...

## ➕ Contruibuição e Código de Conduta
Em breve ....
