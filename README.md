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

