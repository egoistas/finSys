
# finSys

A comprehensive financial management system designed to streamline supply competitions and related financial operations.

## Features

- **Supply Competition Management**: Efficiently handle various supply competitions with ease.
- **Financial Operations**: Manage financial transactions and records seamlessly.
- **User Authentication**: Secure login system for authorized access.
- **Data Analytics**: Generate insightful reports and analytics.

## Project Structure

The repository is organized as follows:

- **`config/`**: Configuration files for application settings.
- **`custom/`**: Custom scripts and utilities.
- **`handlers/`**: Scripts handling various operations and requests.
- **`includes/`**: PHP includes for modular code segments.
- **`public/`**: Publicly accessible files, including the main entry point.
- **`temp/`**: Temporary files and data storage.
- **`templates/`**: HTML templates for consistent UI rendering.
- **`views/`**: Scripts responsible for rendering views.
- **`.htaccess_rename`**: Apache configuration file (rename to `.htaccess` for use).
- **`index.php`**: Main entry point of the application.
- **`index_rename.php`**: Alternative entry point (rename as needed).

## Installation

To set up the project locally:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/egoistas/finSys.git
   ```
2. **Navigate to the Project Directory**:
   ```bash
   cd finSys
   ```
3. **Configure the Application**:
   - Rename `.htaccess_rename` to `.htaccess`.
   - Rename `index_rename.php` to `index.php` if necessary.
4. **Set Up the Database**:
   - Create a MySQL database for the application.
   - Import the provided SQL file to set up the necessary tables.
   - Update database connection settings in `includes/mysqli_connect.php`.
5. **Run the Application**:
   - Ensure a local server environment (e.g., XAMPP) is running.
   - Access the application via `http://localhost/finSys` in your web browser.

## Usage

- **Admin Panel**: Manage supply competitions, financial records, and user accounts.
- **User Dashboard**: View and participate in supply competitions, and manage personal financial data.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your proposed changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

Special thanks to all contributors and supporters of this project.
