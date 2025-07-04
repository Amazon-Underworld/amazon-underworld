# hacklabr

Este repositório contém os arquivos iniciais para se ter um projeto WordPress
nos moldes do Hacklab. Isso significa que as ferramentas de desenvolvimento
e deploy estão protegidas por um padrão.

A ideia é que seja feito um fork deste repositório para começar um novo projeto
WordPress. Os arquivos deverão ser modificados conforme as peculiaridades do
projeto.

## Desenvolvimento

### Editor

Para o desenvolvimento recomenda-se a utilização do editor Visual Studio Code com as seguintes extensões:

- EditorConfig for VS Code
- PHP Intelephense
- SCSS IntelliSense
- Docker
- GitLens
- ...

### Requisitos

Para o desenvolvimento é requisito ter instaladas ao menos as seguintes ferramtas:

- **Git**
- **Docker** e **Docker Compose** - Docker é a ferramenta recomendada para desenvolver localmente. Para instalá-lo siga [estas instruções](https://docs.docker.com/install/#supported-platforms).
- **node** e **npm**

### Clonando o repositório

Clone o repositório e seus submódulos recursivamente:

```bash
git clone git@git.hacklab.com.br:open-source/base-wordpress-project.git --recursive
```

### Adicionando submódulos

Exemplo aplicando o plugin Hacklab Blocks como submódulo na pasta `/plugins`. O `-f` é necessário quando a pasta `plugins` está no `.gitignore`

```bash
git submodule add -f git@gitlab.hacklab.com.br:open-source/hacklab-blocks.git plugins/hacklab-blocks
```

### Acesso a atualizações do tema base

Para receber novas funcionalidades do tema base diretamente no seu board, é pré-requisito inserir o repositório do tema base como um `remote` do Git:

```bash
git remote add temaBase git@git.hacklab.com.br:open-source/base-wordpress-project.git
```

Então, para sincronizar o tema base com seu fork, rode o seguinte comando no branch `develop` do seu fork:

```bash
git pull temaBase develop
```

### Compilando os assets do tema

Abra um terminal, vá até a a pasta `themes/amazon-underworld/` e execute os comandos abaixo:

```bash
npm install
npm run watch # vai ficar observando as mudanças nos assets
```

### Subindo o ambiente

Abra outro terminal e na raíz do repositório execute o comando abaixo:

```bash
docker-compose up
```

### Scripts para desenvolvimento

Há uma série de scripts úteis na pasta `dev-scripts`:

- **dump** - faz um dump do banco de desenvolvimento<br>
    exemplo de uso: `dev-scripts/$ ./dump > dump.sql`
- **mysql** - entra no shell do MySQL com o usuário `wordpress`
- **mysql-root** - entra no shell do MySQL com o usuário `root`
- **wp** - executa o comando WP-CLI dentro do container `wordpress`<br>
    exemplo de uso: `dev-scripts/$ ./wp search-replace https:// http://`

Acesse http://localhost para ver o site.

### Importar um dump de banco de dados

Se você tem um dump de banco de dados `.sql` ou `.sql.gz`, para importá-lo em sua versão local, copie o arquivo para `compose/local/mariadb/data` e execute:

```bash
docker-compose down -v # o parametro -v apaga os dados do mariadb
docker-compose up
```

### Substituir strings

- Renomear o nome do tema no arquivo `style.css`

### Variáveis de ambiente

#### Variáveis da imagem WordPress

https://hub.docker.com/_/wordpress

Exemplo: desativando o debug do WordPress

```yaml
WORDPRESS_DEBUG: 0
```

### Configurações PHP

Editar arquivo `compose/local/wordpress/php/extra.ini` e reiniciar container

Exemplo: desativando avisos de recursos depreciados do PHP

```ini
error_reporting = E_ALL & ~E_NOTICE & ~E_DEPRECATED
```

### Debug utilizando PSY

1. Você ja deve ter rodado o `docker-compose up` pelo menos uma vez
2. Instale e ative o plugin `hacklab-dev-utils` (esse plugin é um submódulo desse repositório, caso não tenha clonado o repositório com `--recursive`, rode `git submodule init` e depois `git submodule update`)

Para iniciar o ambiente de debug, rode o script `./dev-scripts/dev.sh`

Adicione `<?php eval(\psy\sh()); ?>` na linha onde deseja debugar. No terminal, o código será interrompido exatamente no lugar onde adicionou o comando e você terá às variavés declaradas, classes instanciadas, funções disponíveis e etc.

#### Exemplo

Ao adicionar `eval(\psy\sh());` dentro do loop você pode chamar a função get_the_title() no terminal.

#### Adicione um snippet no VS Code

- Pressione `Ctrl + Shift + P`, va em *Configure User Snippets*
- Selecione PHP
- E adicione:

```json
"psy": {
    "scope": "php",
    "prefix": "psy",
    "body": [
        "eval(\\psy\\sh());",
    ],
}
```

Com isso, ao digitar `psy` e pressionar a tecla `Tab`, o VS Code vai imprimir o códígo `eval(\\psy\\sh());`

Para sair desbloquear o processo de debug no terminal, utilize o comando `exit`.

## Instalando plugins e temas

### Copiando arquivos para dentro do repositório

O conteúdo de `wp-content` está excluído do versionamento por padrão. Para adicionar seu plugin ou tema como parte do repositório, você deve colocá-los nas pastas `plugins` ou `themes` que estão na raiz do repositório.

## Traduções

Quando utilizar o comando `wp i18n make-json languages/` para gerar as traduções de arquivos `.js` e as traduções não funcionarem, uma das possíveis soluções pode ser renomear o arquivo gerado de `{locale}-{hash}.json` para `{domain}-{locale}-{script-handle}.json`.

## Github Workflow e plugin git-updater (v12.4.0)
Para que o plugin funcione corretamente devemos ter o nome da pasta do tema, o nome do repositório no github e o a slug configurada no plugin sendo a mesma string. Por exemplo:
pasta do tema no repo: themes/novo-nome
endereço do repo: github.com/hacklabr/novo-nome
Slug configurada no plugin: novo-nome

Além disso precisamos ter um link simbolico na raiz do repo apontando para o arquivo style.css dentro da pasta do tema.

Para que a estrutura dos arquivos do repositório siga esse padrão você deve executar, logo após clonar, o script dev-scripts/cria-tema.sh que faz as seguintes alterações:
- altera a pasta do tema
- substitui em massa a string amazon-underworld pelo novo nome
- cria o link simbolico entre /themes/novo-nome/style.css e /style.css
- altera a versão do tema para 0.1


### outras alterações:
- a variável CURL_URL no arquivo .github/workflows/main.yml com a URL do ambiente a ser atualizado (o plugin git-updater deve estar instalado e o tema adicionado na aba additions)
- a variável DEPLOY no arquivo .github/workflows/main.yml com um número diferente de 0 se desejar atualizações automáticas.

### observações importantes: 
- para atualizar o tema no ambiente usando o plugin a versão na tag do repositório deve ser igual à versão do tema no style.css
