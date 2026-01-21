## アプリケーション名

お問い合わせ管理アプリ

## 環境構築

```
ここに手順を記載
テスト
```

## ER 図

<!-- ![ER図](./docs/er.png) -->

（Mermaid）
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
