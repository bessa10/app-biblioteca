## API Biblioteca

Esta API será responsável pelo cadastro de autores, livros e empréstimo dos livros.

[documentation](https://documenter.getpostman.com/view/4953650/2sA3QpBD3o)

## Configuração inicial

- Antes de iniciar o projeto copie o arquivo .env-example e cole renomeando para .env.

- Rodar o comando "php artisan jwt:secret" para gerar a chave de assinatura para a autenticação JWT

## Dependencias:

- Composer (php): [https://getcomposer.org/](https://getcomposer.org/)

Executar os seguintes comandos na raiz do projeto:

- composer install

## Banco de dados

- Alterar as configurações de acesso no arquivo .env

- Rodar o comando no terminal "php artisan migrate" para gerar o banco de dados

## Servidor de teste

- Para iniciar o servidor de teste, rodar o comando "php artisan serve"