# Freelance Platform

A web application designed for freelancers and clients to connect, post gigs, and manage their tasks efficiently. This platform includes features for user management, gig management, reporting, and authentication.

---

## Project Structure

```plaintext
Project Directory:
├── docs/
│   ├── ERD.png
│   ├── UML.svg
├── public/
│   ├── admin.php
│   ├── client.php
│   ├── delete-gig.php
│   ├── freelancer.php
│   ├── gig-create.php
│   ├── gig.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── modify-gig-handler.php
│   ├── modify-gig.php
│   ├── report_gig.php
│   ├── signup.php
│   ├── validate_key.php
│   ├── verify-email.php
├── src/
│   ├── database/
│   │   ├── db.php
│   ├── input.css
│   ├── output.css
├── vendor/
│   ├── phpmailer/ (installed via Composer)
├── composer.json
├── composer.lock
├── README.md
├── tailwind.config.js
```

---

## Features

- **User Management**: 
  - Role-based system for freelancers and clients.
  - Email verification for account activation.
  - Secure authentication using hashed passwords.
  
- **Gig Management**: 
  - Create, modify, and delete gigs.
  - Support for gig categories, subcategories, and skills.
  - Track deleted gigs for record-keeping.

- **Reporting System**:
  - Users can report gigs or other users.
  - Records include sender and gig details with timestamps.

- **Email System**:
  - Uses PHPMailer (installed via Composer) for email notifications and verification.

---

## Database Structure

### Tables Overview

1. **users**
   - Fields: `id`, `email`, `username`, `password`, `role`, `created_at`, `status`, `verified`, `verification_token`.
   - Roles: `freelancer` or `client`.
   - Status options: `pending`, `active`, `banned`, `refused`.

2. **gigs**
   - Fields: `id`, `title`, `description`, `price`, `category`, `skills`, `delivery_time`, `gig_type`, `status`, `freelancer_id`, etc.
   - Relationship: References `users` table via `freelancer_id`.

3. **security_keys**
   - Fields: `id`, `security_key`.

4. **deleted_gigs**
   - Fields: `id`, `gig_title`, `freelancer_id`, `freelancer_name`, `deletion_time`.

5. **reports**
   - Fields: `id`, `report_sender_id`, `report_sender_name`, `gig_id`, `gig_title`, `gig_creator_id`, `report_time`.

---

## Setting Up the Project

### Step 1: Clone the Repository

```bash
git clone https://github.com/Youcode-Classe-E-2024-2025/Hamza-Atig-manager.git
```

### Step 2: Install Composer

If Composer is not already installed on your system, download and install it from the [official website](https://getcomposer.org/).

### Step 3: Install Dependencies

Navigate to your project root directory and run the following command:

```bash
composer install
```

This will install PHPMailer and any other dependencies specified in `composer.json`.

### Step 4: Install PHPMailer Manually (If Not Installed)

If PHPMailer is not included, you can manually install it:

```bash
composer require phpmailer/phpmailer
```

### Step 5: Set Up the Database

1. Create a database named `freelanceplatform`.
2. Run the following SQL script to create the required tables:

```sql
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('freelancer', 'client') NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('pending', 'active', 'banned', 'refused') NOT NULL,
    `verified` INT DEFAULT 0,
    `verification_token` VARCHAR(32) DEFAULT NULL
);

CREATE TABLE `gigs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `subcategory` VARCHAR(100) NOT NULL,
    `skills` VARCHAR(255) NOT NULL,
    `experience` VARCHAR(100) NOT NULL,
    `delivery_time` VARCHAR(100) NOT NULL,
    `gig_type` VARCHAR(100) NOT NULL,
    `status` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `freelancer_id` INT,
    FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `security_keys` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `security_key` VARCHAR(255) NOT NULL
);

CREATE TABLE `deleted_gigs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `gig_title` VARCHAR(255) NOT NULL,
    `freelancer_id` INT,
    `freelancer_name` VARCHAR(100) NOT NULL,
    `deletion_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `reports` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `report_sender_id` INT,
    `report_sender_name` VARCHAR(100),
    `gig_id` INT,
    `gig_title` VARCHAR(255),
    `gig_creator_id` INT,
    `gig_creator_name` VARCHAR(100),
    `report_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Step 6: Configure Database Connection

Edit the `db.php` file in `src/database/` with your local database credentials:

```php
$host = 'localhost';
$dbname = 'freelanceplatform';
$user = 'your_database_username';
$pass = 'your_database_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
```

### Step 7: Run the Application

Use Laragon, XAMPP, or any other local server environment to serve the project. Make sure the `public/` directory is your document root.

---

## Technologies Used

- **Backend**: PHP
- **Frontend**: Tailwind CSS
- **Database**: MySQL
- **Email**: PHPMailer
- **Development Environment**: Laragon

---

## License

This project is licensed under the [MIT License](LICENSE).

