# Blog Challenge

## setup steps

### 1. installation

```bash
git clone git@github.com:MohammadMehrabani/blog.git 
cd blog
cp .env.example .env
docker compose up -d --build web
docker compose exec php composer install
docker compose exec php php artisan key:generate
docker compose exec php php artisan storage:link
docker compose exec php php artisan jwt:secret
```

#### update variables in `.env` (optional)

```dotenv
DOCKER_DB_PORT=3306
DOCKER_APP_PORT=80
```

### 2. migrate tables

```bash
docker compose exec php php artisan migrate
docker compose exec php php artisan db:seed
```

## information for test

You can quickly test the application using the pre-seeded `user` with `mobile = 09121111111` and `password = password`.

## webservice usage

### login

```bash
curl --location 'http://127.0.0.1:8000/api/auth/login' \
--header 'accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "mobile": "09121111111",
    "password": "password"
}'
```

### read post

```bash
curl --location 'http://127.0.0.1:8000/api/posts/{POST_ID}' \
--header 'accept: application/json' \
--header 'Authorization: Bearer {TOKEN}'
```

### list posts

```bash
curl --location 'http://127.0.0.1:8000/api/posts' \
--header 'accept: application/json' \
--header 'Authorization: Bearer {TOKEN}'
```

### list users

```bash
curl --location 'http://127.0.0.1:8000/api/users' \
--header 'accept: application/json' \
--header 'Authorization: Bearer {TOKEN}'
```

### update user avatar

```bash
curl --location 'http://127.0.0.1:8000/api/users/update-avatar' \
--header 'accept: application/json' \
--header 'Authorization: Bearer {TOKEN}' \
--form 'avatar=@"/home/test/Desktop/image.jpg"'
```

## OpenAPI / swagger documentation
[Blog.swagger.yaml](Blog.swagger.yaml)

## postman documentation
https://documenter.getpostman.com/view/36957369/2sB3WsPz9m

## postman collection
[Blog.postman_collection.json](Blog.postman_collection.json)
