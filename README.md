
# Server-Sent Events (SSE)

Os eventos enviados pelo servidor permitem que uma página da Web receba atualizações de um servidor.

## php-sse

Esse simples projeto aborda o uso dessa tecnologia da seguinte forma:

- No front-end uma página .html que vai receber os eventos;

- E no back-end o mecanismo sse.php e uma interface de criação das mensagens que serão enviadas.

## Stack utilizada

**Front-end:** Bootstrap 5.3.3;

**Back-end:** PHP 8.3.3 sob um servidor Apache 2.4.58 e base de dados MySQL 8.0.30.


## Instalação

*Obrigatório uso do Composer;

Faça o donwload desse projeto e em seguida, em sua raiz, execute o seguinte comando para baixar as dependências do projeto via composer.

```bash
composer install
```
## Arquitetura do projeto

```bash
php-sse
    public
        client
            index.html (Página que recebe os eventos)
        server
            sse
                sse.php (Mecanismo SSE)
            index.php (Página que envia os eventos)
    source
        Models
        Config.php (Arquivo de configuração da base de dados)
    composer.json
```
    
Script de criação da base de dados MySQL

```bash
CREATE DATABASE php_sse;
USE php_sse;
CREATE TABLE `messages` (
    `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `message` VARCHAR(299) NOT NULL COLLATE 'utf8mb4_general_ci',
    `sent` CHAR(1) NOT NULL DEFAULT 'n' COLLATE 'utf8mb4_general_ci',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    UNIQUE INDEX `id` (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
```
    
