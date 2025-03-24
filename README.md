# GreenEdge-API

## Introduction

This is a Symfony 7 API application designed to provide a robust and scalable backend for your project. It follows best practices for API development, including authentication, validation, and structured responses.

## Requirements

- Docker & Docker Compose

- Symfony CLI (optional but recommended)

## Installation

1. Clone the Repository

git clone https://github.com/TBW1wnl/GreenEdge-API.git

2. Start the Application with Docker

docker-compose up -d --build

This will start the PHP, Nginx, PostgreSQL, Adminer, and Mailer services.

3. Set Up the Database

docker-compose exec php php bin/console doctrine:database:create
docker-compose exec php php bin/console doctrine:migrations:migrate

Running Tests

To run tests, use:

docker-compose exec php php bin/phpunit

API Documentation

This project includes API documentation using OpenAPI (Swagger). To access it, visit:

http://127.0.0.1:8000/api/docs

Authentication

This API uses JWT (JSON Web Token) for authentication. To get started:

Login and retrieve a token using:

POST /api/login
{
    "username": "your_email@example.com",
    "password": "your_password"
}

Include the token in your requests as:

Authorization: Bearer {your_token}

Deployment

For production deployment, follow these steps:

Set up a web server (Nginx, Apache)

Configure environment variables

Run database migrations

Set permissions for cache and logs folders:

chmod -R 777 var/cache var/log

Use a process manager like Supervisor or PM2 for background tasks

Docker Configuration

This project includes a Docker setup with the following services:

PHP (FPM) configured with Symfony

Nginx as the web server

PostgreSQL as the database

Adminer for database management

Mailpit for email testing
