# PHP CRUD Application

A simple PHP CRUD (Create, Read, Update, Delete) application for managing user data using PDO for database connections.

## Features

- Create new users
- Read/search for users by location
- Update existing user information
- Delete users from the database
- Secure database connections using PDO
- Input sanitization to prevent XSS attacks

## Directory Structure

```
CRUD-App/
├── config/              # Configuration files
│   ├── config.php       # Database connection settings
│   ├── common.php       # Helper functions
│   └── install.php      # Database initialization script
├── data/                # Database scripts
│   └── init.sql         # SQL initialization script
├── public/              # Public-facing files
│   ├── css/             # Stylesheets
│   │   └── style.css    # Main stylesheet
│   ├── templates/       # Reusable template files
│   │   ├── header.php   # Header template
│   │   └── footer.php   # Footer template
│   ├── index.php        # Main entry point
│   ├── create.php       # Add new users
│   ├── read.php         # Search for users
│   ├── update.php       # List users for editing
│   ├── update-single.php # Edit individual users
│   └── delete.php       # Delete users
└── src/                 # Source files
    └── DBconnect.php    # Database connection class
```

## Installation

1. Clone this repository to your local PHP server environment
2. Make sure you have a MySQL server running
3. Navigate to `config/install.php` in your browser to set up the database
4. Access the application through the main index.php file

## Requirements

- PHP 7.0+
- MySQL 5.7+
- PDO PHP Extension

## Usage

- Use the navigation links to access different CRUD operations
- Create new users with the Create page
- Search for users by location with the Read page
- Edit user information with the Update page
- Remove users with the Delete page
