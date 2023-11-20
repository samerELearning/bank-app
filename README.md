# Project: Banking Web Application
The objective of this project is to design and implement a banking web application with fundamental functionalities. The application caters to two types of users: clients and banking agents. The web platform adopts a back-end-centric approach, employing PHP and Laravel technologies. It adheres to the Model-View-Controller (MVC) design pattern and stores data in a SQL-based Database Management System (DBMS). The front-end is developed using HTML5 and CSS technologies.

## Features

### 1. User Registration and Authentication

- Allow guest users to create login accounts.
- Enable registered users to log in to the system securely.
- Note: Banking agents' accounts are externally created by the system administrator.

### 2. Creating Bank Accounts

- Users can create a banking account by providing necessary information.
- Option to create multiple bank accounts with choices of currencies (LBP, USD, EUR).
- Account creation finalization is subject to approval from a banking agent.

### 3. Client Operations

- Clients can view detailed account information.
- Facilitate fund transfers between accounts with ease.
- Provide a comprehensive transaction history with filtering options.
- Check the status of account creation requests.

### 4. Bank Agent Operations

- Access all client operations and account details.
- Review and approve/disapprove account creation requests.
- View the listing of clients and their respective accounts.
- Ability to disable/enable client access to their accounts.
- Execute deposit/withdrawal transactions upon physical client requests.

### 5. Security

- Passwords stored in hashed format to enhance security.
- Implement robust measures to safeguard banking pages from unauthorized access.
- Utilize solutions to prevent code injection and bolster overall system security.

## Technologies Used

- HTML5
- CSS3
- PHP
- Laravel
- MySQL

## Architecture

Model-View-Controller (MVC)

## Getting Started

1. Clone the repository: `git clone https://github.com/<username>/sports-manager-website.git`
2. Install dependencies: `composer install`
3. Configure the database settings in the `.env` file
4. Run migrations and seeders: `php artisan migrate --seed`
5. Run the application: `php artisan serve`

## Credits

This project is being developed by Samer Saber as part of a project for a web development course at the Lebanese American University/
