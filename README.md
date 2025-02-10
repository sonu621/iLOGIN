# iLOGIN

iLOGIN is a user management system built with PHP, MySQL, and Bootstrap. It allows administrators to manage users, including adding, editing, and deleting user records. The system also includes features such as image uploads, role management, and a responsive UI.

## Features

- User Authentication: Secure login and registration system.
- User Management: Add, edit, and delete user records.
- Image Upload: Upload and display user profile images.
- Role Management: Assign roles to users (e.g., user, admin).
- Responsive UI: Built with Bootstrap for a responsive and modern interface.
- DataTables Integration: Enhanced table UI with search, pagination, and sorting.

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/ilogin.git
   ```

2. **Navigate to the project directory:**
   ```bash
   cd ilogin
   ```

3. **Create the database table:**
- Create a MySQL database named `login_register`.
- Import the following SQL script to create the necessary tables:
   ```sql
   CREATE TABLE `details` (
       `id` INT NOT NULL AUTO_INCREMENT,
       `name` VARCHAR(255) NOT NULL,
       `image` VARCHAR(255) NOT NULL,
       `country` VARCHAR(255) NOT NULL,
       `gender` VARCHAR(50) NOT NULL,
       PRIMARY KEY (`id`)
   );
   ```
4. **Congigure the database connection:**
- Open `connection.php`.
- Update the database credentials(`$servername`,`$username`,`$password`,`$dbname`) to  mathc your MYSQL setup.

5. **Start the server:**

- If using XAMPP, place the project folder in the htdocs directory.
- Start Apache and MySQL from the XAMPP control panel.
- Open your browser and navigate to `http://localhost/ilogin`.

**Usage** 
1.  a new user:

- Navigate to the registration page (`register.php`).
- Fill in the required details and submit the form.

2. **Login:**

- Navigate to the login page (`login.php`).
- Enter your credentials and log in.

3. **Manage Users:**

- After logging in as an admin, navigate to the settings page (`setting.php`).
- Use the "Add User" button to add new users.
- Use the edit and delete buttons to manage existing users.

## Project Structure

```
ilogin/
├── includes/
│   ├── connection.php       # Database connection file
│   ├── header.php           # Header file with navigation
│   ├── footer.php           # Footer file with scripts
├── uploads/                 # Directory for uploaded images
├── index.php                # Home page
├── login.php                # Login page
├── register.php             # Registration page
├── setting.php              # User management page
├── server.php               # Server-side script for handling form submissions
├── README.md                # Project documentation
```

**Dependencies**
- PHP
- MySQL
- Bootstrap 5
- jQuery
- DataTables

**License**

This project is licensed under the MIT License. See the LICENSE file for details.

**Contributing**

Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.


**Contact**

For any questions or inquiries, please contact [sanjiwgpt55@gmail.com].

This `README.md` file provides a comprehensive overview of the project, including features, installation instructions, usage, project structure, dependencies, license, contributing guidelines, and contact information.

