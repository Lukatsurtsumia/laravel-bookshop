# 📚 Laravel Bookshop

A full-stack **book e-commerce platform** built with Laravel where users can browse books, leave ratings and comments, and purchase books using a point-based system.

This project demonstrates modern Laravel development including authentication, Livewire components, service-layer architecture, database relationships, and an admin management system.

---
# 🚀 Features

## User Features

- New users receive **500 welcome bonus points**
- Browse and search books by:
  - Title
  - Author
  - Category
  - Rating
  - Price
- Dynamic **search and filtering**
- View **similar books** on each book page
- Add books to **cart**
- Purchase books using **points**
- Leave **comments and ratings**
- View **purchase history**
- View personal **ratings and comments** in profile

---
## Book System

Each book includes:

- Title
- Author
- Category
- Price
- Rating system
- User comments

Books can be searched and filtered dynamically for better user experience.

---
## User Experience

When opening the website, users see:

- A **3D animated book**
- Famous **quotes and authors**

Each book page displays:

- Book information
- User ratings
- Comments
- Similar books suggestions

---
# 🛒 Cart & Purchase System

Users can:

- Add books to their cart
- Purchase books using points
- Track their purchase history
- View purchased books in their profile

---
# 🛠 Admin Panel

The admin controls the entire system.

Admin features include:
- Full **Book CRUD management**
- Manage users
- Delete user comments
- View all purchases
- Search and paginate through all data

All admin pages support:
- Pagination
- Search functionality

---
# ⚙️ Tech Stack

### Backend
- Laravel
- Laravel Breeze (Authentication)
- Livewire

### Frontend
- Blade Templates
- Tailwind CSS
- Alpine.js
- JavaScript

### Database
- MySQL
- Laravel Migrations
- Eloquent Relationships

---
# 🏗 Architecture

The project follows **clean Laravel architecture**:

- Controllers
- Models
- Services (BookService)
- Migrations
- Seeders
- Factories

Database relationships include:

- One-to-Many
- Many-to-Many

Examples:
- Users → Comments
- Books → Comments
- Users → Orders
- Orders → Books

---
# 🧪 Development & Testing

To quickly populate the database, the project uses:

- Laravel Factories
- Laravel Seeders

These generate:

- Random books
- Sample users
- Test data

---
# 🐳 Development Environment

The project runs in a containerized environment using:

- Docker
- Ubuntu (WSL on Windows)

---
# 🎯 Purpose

This project was built as a **portfolio project** to demonstrate:

- Full Laravel application development
- Dynamic interfaces using Livewire
- Clean code architecture
- Admin panel management
- Database design and relationships

---
# 👨‍💻 Author

Luka Tsurtsumia

GitHub:  
https://github.com/lukatsurtsumia
