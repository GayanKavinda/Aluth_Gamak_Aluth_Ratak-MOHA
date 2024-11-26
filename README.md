# 🌍 Aluth Gamak Aluth Ratak - MOHA

### Revitalizing Sri Lanka's Rural Areas

The **"Aluth Gamak Aluth Ratak"** program, under the **Ministry of Home Affairs (MOHA)**, is designed to improve rural areas in Sri Lanka by integrating agriculture, infrastructure, and education. This program aims to enhance resources for farmers, improve roads, irrigation, healthcare, and education, ultimately fostering a skilled and healthy workforce. The program supports economic diversification for a sustainable and prosperous future.

---

## 🛠 Technologies Used

- **Laravel** – PHP framework for building the web application
- **Spatie** – For user authentication and role management
- **XAMPP** – Local server environment
- **PHPMyAdmin** – Database management
- **CSS/JS** – Styling and client-side interactivity
- **REST API** – For communication between the client and server
- **Figma** – For wireframing and design
- **Icons** – Font Awesome and custom icons for enhanced UI

---

## 📋 About This Project

The **Performance Agreement System** ("Aluth Gamak Aluth Ratak") is built to streamline the process of contracting with the 25 district secretariats across Sri Lanka. Each district sends quarterly reports to the Ministry outlining the tasks they aim to complete, which are vital for data gathering and progress monitoring.

The system offers a dashboard for tracking progress, data sheets for detailed reporting, and messaging features for communication between stakeholders. User roles and permissions ensure secure access to information. Additionally, the system supports exporting data in **PDF**, **CSV**, and **Excel** formats for easier analysis and reporting.

### Key Features:
- **Dashboard**: Provides an overview of key metrics and system usage.
- **Data Sheet**: Allows for detailed reporting on various sectors.
- **Messaging**: Send private or public messages between users.
- **Data Visualization**: Provides charts for visual insights into data trends, including quarter totals and percentages.
- **History Tracking**: Super admins can view the history of changes made by users across the system.

---

## 🔧 Key Components

### 📝 Forms
- **Economic Form**
- **Social Form**
- **Poverty Alleviation Form**
- **Health and Nutrition Form**
- **Agriculture Form**
- **Environment Form**
- **Government Revenue Form**
- **Public Expenditure Form**
- **Other Data Submission Form**

### 👥 User Management
- **User Registration**
- **Role Management**
- **Permissions Assignment**
- **Permission List**

### CRUD Operations
- Create, Read, Update, Delete operations are implemented for all forms and data.

### 📊 Data Export
- Users can download data in **CSV**, **Excel**, and **PDF** formats.

### 🔒 Authentication
- **Laravel Auth** used for user authentication and access control.

### 🖼 Icons
- Utilized throughout the UI for improved user experience.

---

## 📦 Installation

Follow the steps below to set up the project locally:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/aluth-gamak-aluth-ratak.git

2. **Install dependencies: Navigate to the project folder and install the required dependencies:**:
   ```bash
   cd aluth-gamak-aluth-ratak
   composer install
   npm install

3. **Set up the .env file: Copy .env.example to .env**:
   ```bash
   cp .env.example .env

4. **Generate the application key:**:
   ```bash
   php artisan key:generate

Set up the database:
- **Create a database in PHPMyAdmin (or any other MySQL tool).
- **Update the .env file with your database credentials.

5. **Run migrations**:
   ```bash
   php artisan migrate

6. **Start the development server**:
   ```bash
   php artisan serve

Set up the database:
- **Visit the application at http://localhost:8000

---

## 🌐 Usage

- **Admin Panel: Administrators can manage roles, permissions, and data.**
- **User Dashboard: Users can view reports, send messages, and track progress.**
- **Forms: Complete and submit forms in various sectors.**
- **Export Data: Download progress and reports in PDF, CSV, or Excel formats.**
- **History Tracking: Super admins can see a log of changes made by users.**

---

## 📖 Documentation

- **User Registration**: New users can register and get access based on their roles.
- **Roles & Permissions**: Use Spatie’s role and permission system for access control.
- **CRUD Operations**: All forms allow users to create, read, update, and delete entries.
- **Messaging**: Secure messaging system with public and private message options.
- **Data Visualization**: Charts for easy analysis of trends and data.

---

## 🛠 Contributing

1. Fork the repository.
2. Create a new branch for your feature or fix.
3. Commit your changes.
4. Push to your fork and create a pull request.

---

## 📝 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

---

## 🤝 Acknowledgements

- **Laravel**: For providing an elegant framework for web applications.
- **Spatie**: For their role and permission package.
- **XAMPP**: Local development environment for testing.
- **Figma**: For the wireframing and UI design tool.
