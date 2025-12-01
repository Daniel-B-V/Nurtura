# 🏠 Nurtura Orphanage Care Platform

![Laravel](https://img.shields.io/badge/Laravel-12.39.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2.12-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Latest-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

A comprehensive web-based management system designed to streamline operations for orphanages and childcare facilities. Built with Laravel 12 and powered by AI-assisted features.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Installation](#installation)
- [User Roles](#user-roles)
- [Database Schema](#database-schema)
- [Security Features](#security-features)
- [Contributing](#contributing)
- [License](#license)

## 🌟 Overview

Nurtura is a full-featured orphanage management platform that helps organizations efficiently manage children, staff, donors, volunteers, inventory, and generate comprehensive reports. The system includes role-based access control, task management, activity logging, and AI-powered donor-child matching.

### Key Highlights

- 🎯 **Complete CRUD Operations** for all modules
- 👥 **Role-Based Access Control** (Admin & User roles)
- 📊 **Advanced Reporting & Analytics** with export functionality
- 🤖 **AI-Powered Donor-Child Matching**
- 📦 **Inventory Management** with stock alerts
- ✅ **Task Management System** for staff
- 📝 **Activity Logging & Audit Trail**
- 🔍 **Global Search** across all entities
- 📱 **Responsive Design** for all devices

## ✨ Features

### 👨‍💼 Admin Features

#### Dashboard
- Financial overview with donation trends
- Quick statistics (children, donors, volunteers)
- Inventory alerts and low stock warnings
- AI recommendations
- Recent activity monitoring

#### Children Management
- Complete child profile management
- Health records tracking
- Education progress monitoring
- Document storage
- Status management (Active, Sponsored, Adopted)
- Age and health filtering

#### Donors & Volunteers
- Donor management with contribution tracking
- AI-powered donor-child matching system
- Volunteer scheduling and hours tracking
- Contact information management
- Donation history and frequency tracking

#### Inventory Management
- Item tracking with categories
- Stock level monitoring
- Restock functionality
- Low stock alerts
- Transaction history
- Usage tracking

#### Reports & Analytics
- Donation trend analysis
- Expense breakdown charts
- Welfare metrics tracking
- Period filtering (1 week, 1 month, 3 months)
- CSV export functionality
- Visual charts and graphs

#### Settings
- System configuration
- Notification preferences
- Security settings
- User management

### 👤 User/Staff Features

#### Personal Dashboard
- Task-focused overview
- Quick statistics (pending tasks, overdue, completed)
- Recent activities summary
- Children overview

#### My Tasks
- View assigned tasks
- Priority-based task listing
- Overdue task highlighting
- Task completion workflow
- Due date tracking
- Child-related task assignments

#### My Activity
- Personal activity timeline
- Action type filtering
- Date range filtering (7/30/90 days)
- Activity statistics
- Pagination for history

#### Children (View-Only)
- Browse children profiles
- View health and education records
- Filter and search capabilities
- No modification access

## 🛠️ Technology Stack

### Backend
- **Framework:** Laravel 12.39.0
- **Language:** PHP 8.2.12
- **Database:** PostgreSQL
- **Authentication:** Laravel Breeze
- **ORM:** Eloquent

### Frontend
- **CSS Framework:** Tailwind CSS
- **JavaScript:** Alpine.js
- **Template Engine:** Blade
- **Build Tool:** Vite

### Additional Tools
- **Version Control:** Git
- **Package Manager:** Composer, NPM
- **Session Driver:** Database
- **Cache Driver:** Database
- **Queue Driver:** Database

## 🚀 Installation

### Prerequisites

- PHP >= 8.2
- Composer
- PostgreSQL
- Node.js & NPM
- Git

### Setup Instructions

1. **Clone the repository**
```bash
git clone https://github.com/Daniel-B-V/Nurtura.git
cd Nurtura
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
```

4. **Environment configuration**
```bash
cp .env.example .env
```

5. **Configure database in .env**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nurtura
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Generate application key**
```bash
php artisan key:generate
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Seed the database (optional)**
```bash
php artisan db:seed
```

9. **Create storage symlink**
```bash
php artisan storage:link
```

10. **Build assets**
```bash
npm run build
```

11. **Start development server**
```bash
php artisan serve
```

12. **Access the application**
```
http://localhost:8000
```

## 👥 User Roles

### Admin Role
- **Access Level:** Full system access
- **Permissions:**
  - Create, read, update, delete all resources
  - Access to financial reports and analytics
  - Inventory management
  - System settings configuration
  - User management
  - Export data

### User/Staff Role
- **Access Level:** Limited operational access
- **Permissions:**
  - View children profiles (read-only)
  - Manage assigned tasks
  - Track personal activities
  - Cannot modify system data
  - Cannot access financial reports
  - Cannot manage inventory

### Default Test Accounts

**Admin Account:**
- Email: `test@nurtura.com`
- Password: (set during seeding)

**User Account:**
- Email: `jane@nurtura.com`
- Password: `password`

## 🗄️ Database Schema

### Core Tables

- **users** - System users with role-based access
- **children** - Child profiles and basic information
- **child_health_records** - Medical history and health tracking
- **child_education_records** - Academic progress monitoring
- **child_welfare_notes** - Social and emotional wellbeing notes
- **donors** - Donor profiles and contact information
- **donations** - Financial contribution records
- **volunteers** - Volunteer information and schedules
- **inventory_items** - Stock items and quantities
- **inventory_categories** - Item categorization
- **inventory_transactions** - Stock movement history
- **user_tasks** - Staff task assignments
- **activity_logs** - System-wide activity tracking
- **sponsorships** - Child sponsorship relationships
- **ai_recommendations** - AI-generated matching suggestions

## 🔐 Security Features

- ✅ Role-based access control
- ✅ CSRF protection on all forms
- ✅ XSS protection with escaped output
- ✅ SQL injection prevention via Eloquent ORM
- ✅ Password hashing with bcrypt
- ✅ Email verification
- ✅ Session management
- ✅ Middleware-based route protection
- ✅ Activity logging and audit trails

## 📊 Key Features Breakdown

### Task Management System
- Task assignment to staff members
- Priority levels (Low, Medium, High, Urgent)
- Task types (Health Checkup, Education Assessment, Medical Appointment, etc.)
- Due date tracking
- Overdue task highlighting
- Completion workflow with notes
- Child-related task associations

### Activity Logging
- Comprehensive action tracking
- Old/new value comparison
- IP address recording
- Filterable timeline
- Activity type categorization
- Date range filtering
- User-specific logs

### Inventory Management
- Category-based organization
- Real-time stock tracking
- Automated low stock alerts
- Restock workflow
- Transaction history
- Usage analytics

### Reporting System
- Donation trend analysis
- Expense breakdown
- Welfare metrics tracking
- Period-based filtering
- CSV export functionality
- Visual chart representations

## 🚧 Future Enhancements

- [ ] Email notifications for tasks
- [ ] SMS integration
- [ ] Mobile application
- [ ] Advanced analytics dashboard
- [ ] Document management system
- [ ] Automated report generation
- [ ] Multi-language support
- [ ] API for third-party integrations

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

## 👨‍💻 Development Team

Developed with ❤️ for improving orphanage management systems worldwide.

**Built with assistance from:**
- 🤖 Claude Code - AI-powered development assistant
- 🎨 Tailwind CSS - Utility-first CSS framework
- ⚡ Laravel - PHP web application framework

## 📞 Support

For support, please open an issue in the GitHub repository or contact the development team.

---

**Version:** 2.0.1 AI
**Status:** Production Ready ✅
**Last Updated:** December 2025

Made with 💙 for orphanage care organizations
