
# Info

This app can be used to calculate mortgage loan.

Please see the blow details to setup at local

  

## Prerequisites

```

- PHP > 8.1

- Apache 2.4.52 with mod_rewrite module

- mysql >= 5.6

- Git

- Composer

- Curl

- MCrypt

- PDO PHP Extension

- Mbstring PHP Extension

- Tokenizer PHP Extension

```

## Installation and Setup

  

### 1- Clone

Clone this Repository

  

	git clone git@github.com:tayyabhussainit/loan_app.git

After clone, checkout to branch loan_management

	git checkout loan_management
  

### 2- Root dir

Go to root directory

  

### 3- Environment file

copy env-example to .env

  

### 4- Database setup

Create database and set credentials and database name etc in .env i.e.

  

	DB_CONNECTION=mysql

	DB_HOST=127.0.0.1

	DB_PORT=3306

	DB_DATABASE=<DB NAME>

	DB_USERNAME=<USERNAME>

	DB_PASSWORD=<PASSWORD>

  

### 5- Migration

Run artisan command for migration

	php artisan migrate

  

### 6- Run application

For local setup, run below artisan comman

	php artisan serve --port 8080

This will serve the application at http://localhost:8080

  

### 7- Authentication

Open http://localhost:8080 in browser. Login user after registration

  

### 8- Calculater

After login, you will be redirected to calculater page

## Sample screens

## 1- Login
![Login Screen](https://github.com/tayyabhussainit/loan_app/tree/loan_management/sample_screens/login.png)

## 2- Register
![Register Screen](https://github.com/tayyabhussainit/loan_app/tree/loan_management/sample_screens/register.png)

## 3- Calculater
![Calculater Screen](https://github.com/tayyabhussainit/loan_app/tree/loan_management/sample_screens/calculater.png)

## 4- Sample result amortization plan
![Amortization Plan Screen](https://github.com/tayyabhussainit/loan_app/tree/loan_management/sample_screens/sample_result_amortization.png)

## 5- Sample result amortization plan with extra payment
![Amortization Plan with extra payment Screen](https://github.com/tayyabhussainit/loan_app/tree/loan_management/sample_screens/sample_result_amortization_extra_payment.png)

## Unit tests

Unit tests are written for authentication and monthly payment

run below command to execute unit tests

```

vendor/bin/phpunit

```

  

## API documentation

APIs are developed for authentication, calculater api can only be access with auth token

  

### Register api
```
path : api/register

data : {name: <name>, email: <email>, password: <password>, confirm_password: <password>}
```
  

### Login api
```
path : api/login

data : {email: <email>, password: <password>}
```
  

### Mortgage Loan Calculater api
```
path : api/calculate_monthly_plan

header: {Authorization: Bearer <TOKEN  FROM  LOGIN  API>}

data : {loan_amount: <loan_amount>, loan_term: <loan_term>, annual_interest_rate:<annual_interest_rate>, optional extra_payment:<extra_payment>}
```