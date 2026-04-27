# Education Board Mockup Portal

This project is a web-based educational board portal developed using HTML, CSS, JavaScript, and PHP. It provides an interface for school registration, student results, news highlights, and more.

## Features

- **Home Dashboard**: View latest news, updates, and fast access to student exam registrations.
- **Student Services**: Apply for migration certificates, duplicate marksheets, equivalent certificates, and more.
- **Registration / Login**: Portal authentication for administrators and students.
- **Admin Dashboard**: Manage student applications and registrations.
- **Resource Management**: Access to question papers and statistical data.

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone <your-repository-url>
   ```
2. Move the project folder to your local server directory (e.g., `htdocs` for XAMPP).
3. Create a MySQL database (e.g., `student_portal`).
4. Import your database tables if applicable.
5. Configure database connection in `db_connect.php`:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "student_portal";
   ```
6. Start your local server (Apache & MySQL) and open the project in your browser:
   ```
   http://localhost/web/index.html
   ```

## Note

Please ensure you do not commit sensitive database credentials or actual user data to the public repository.
