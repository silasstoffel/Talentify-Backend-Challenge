# Talentify Backend Challenge

Desafio para programador backend

## Requisitos

-   [PHP 7.4](https://www.php.net/)
-   [Composer](https://getcomposer.org/)
-   [Extensão de PDO MySQL e SQLite](https://www.php.net/manual/en/pdo.installation.php) para o banco escolhido

## Arquitetura

O objetivo é criar uma solução com menor acomplamento possível e sem que core da aplicação não fique dependente de frameworks ou complexidade tecnológica.

Nesse desafio, framework utilizado é lumen, ele é responsável por receber as chamadas e interfaciar com camadas que não são fortamente acompladas a frameworks de complexidade de domínio técnico.

O Controller do Lumen faz chamadas a camada de aplicação injetando todas as dependências necessárias, a camada de aplicação por sua vez chamada as regras de negócios do domínio.

Dessa forma é criado uma certa "independencia" de frameworks, banco de dados e complexidade técnicas.

Abaixo segue um diagrama explicando a divisão de camadas:

![Arquitetura](./docs/assets/diagram.png?raw=true)


## Setup

### Com Docker

Para facilitar o ambiente de execução do projeto, pode ser levantado o ambiente com docker compose, siga os passos:

- Copiar o `.env.example`, renomear a cópia para `.env` e parametrizar conforme necessidade.
- Rodar o comando `docker-compose up -d --build`.
- Acessar o container `docker exec -it ${nome-do-servico} bash`.
- Navegar até `cd /var/www`.
- Instalar dependências: `composer install`.
- Rodar migrations: `php artisan migrate`.
- Rodar seeders: `php artisan db:seed`. O comando irá criar alguns registros de companhias e recrutadores.
- Acessar `http://localhost:8080`

### Setup Manual

- Instalar depêndencias: `composer install`.
- Copiar o `.env.example` e renomear para `.env`.
- Copiar o `.env.example`, renomear a cópia para `.env` e parametrizar conforme necessidade.
- Rodar migrations: `php artisan migrate`.
- Rodar seeders: `php artisan db:seed`. O comando irá criar alguns registros de companhias e recrutadores.
- Levantar um servidor para rodar o projeto: `php -S localhost:8080 -t public`

### Considerações do Setup

Para começar a usar o projeto, serão criados alguns cadastros iniciais se todos os comandos foram criados:

Companhias

```php  
[
    ['id' => '69908679-11c8-4fca-8635-ec3d9042dd14', 'name' => 'Company I'],
    ['id' => '1dc16a2c-ddab-44f4-8ff2-3b1d2c35f7e1', 'name' => 'Company II'],
    ['id' => 'a2ac3097-f7c7-4d56-91da-afcc14cdae56', 'name' => 'Company III'],
    ['id' => '2f35f4e9-7ef3-493d-9cc1-afedf85e3457', 'name' => 'Company IV'],
    ['id' => 'fbcdc88d-3666-492f-83ac-44b3398c4f7a', 'name' => 'Company V']
]
```  

Recrutadores

```php  
[
   [
       'name' => 'Recruiter #01',
       'email' => 'recruiter1@talentify.com',
       'company_id' => '69908679-11c8-4fca-8635-ec3d9042dd14',
       'id' => '129dc0f7-8007-4763-9829-2db288d5f51c',
       'password' => 'talentify'
   ],
   [
       'name' => 'Recruiter #02',
       'email' => 'recruiter2@talentify.com',
       'company_id' => '1dc16a2c-ddab-44f4-8ff2-3b1d2c35f7e1',
       'id' => '1dc16a2c-ddab-44f4-8ff2-3b1d2c35f7e1',
       'password' => 'talentify'
   ]    
]
```  


Agora com a carga inicial de dados, é possível fazer login e cadastrar vagas, para isso, consulte a documentação da api feita usando [OpenAPI Specification - swagger](https://swagger.io/specification/). Para acessar a documentação, na sua própria instalação acesse o endereço: `http://localhost:8080/api-docs/index.html`.



## Testes

Este projeto usa os recursos do framework [Lumen](https://lumen.laravel.com/) para rodar testes, o [Lumen](https://lumen.laravel.com/) por sua vez usa [PHPUnit](https://phpunit.de/) como framework de testes. O projeto tem cobertua de testes unitário e testes de integração (api).

Os testes de integração que usam banco de dados precisa da extensão PDO SQLite, então certique que atenda os requisitos.

Para rodar os testes execute pelo menos um comando das alternativas abaixo:

Unix:

`./vendor/bin/phpunit` ou `composer run tests`

Windows:

`.\vendor\bin\phpunit` ou `composer run tests-windows`

Para efetivar testes de integração o banco de dado utilizado é banco SQLite em memória. A configuração dos testes está parametrizada no arquivo `.env.testing`.

## Extras

Para testar a API de forma visual, pode ser feito tanto pelo swagger `http://localhost:8080/api-docs/index.html` ou pelo [insomnia](https://insomnia.rest/products/insomnia). Caso faça pelo [insomnia](https://insomnia.rest/products/insomnia), no projeto já existe um [arquivo](./Endpoints-Insomnia.json) base que pode ser importado na sua instalação.

Apesar de haver ambas opções de teste visual da API, o teste pode ser feito com qualquer client rest.
