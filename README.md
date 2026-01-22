## アプリケーション名

お問い合わせ管理アプリ

## 環境構築

### Dockerビルド
```bash
git clone https://github.com/なおちゃんのユーザー名/nao-kadai1.git
cd nao-kadai1
docker-compose up -d --build

### Laravel環境構築
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

### 開発環境
お問い合わせフォーム：http://localhost/
ユーザー登録：http://localhost/register
管理画面：http://localhost/admin
phpMyAdmin：http://localhost:8080

###使用技術（実行環境）
PHP 8.1
Laravel 10.x
MySQL 8.0
Nginx
Docker / Docker Compose
Laravel Fortify（認証）

## ER 図

<!-- ![ER図](./docs/er.png) -->

```mermaid
erDiagram
    categories ||--o{ contacts : "has many"
    categories {
        bigint id PK
        varchar content
        timestamp created_at
        timestamp updated_at
    }

    contacts {
        bigint id PK
        bigint categry_id FK
        varchar first_name
        varchar last_name
        tinyint gender
        varchar email
        varchar tel
        varchar address
        varchar building
        text detail
        timestamp created_at
        timestamp updated_at
    }

    users {
        bigint id PK
        varchar name
        varchar email
        varchar password
        timestamp created_at
        timestamp updated_at
    }
