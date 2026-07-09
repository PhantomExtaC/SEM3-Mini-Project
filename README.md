# 🏡 Casca – Property Management System

<div align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
</div>

<br>

A robust, web-based Property Management System (PMS) designed to streamline communication between landlords and tenants. Casca provides secure, role-based portals where tenants can raise maintenance requests and landlords can easily track, manage, and resolve property issues from a centralized dashboard.

🔗 **Live Demo**
*🌐 Website: [Link to your live site or demo video here]*

---

## 📖 Overview & Business Value

Casca was developed to solve a critical business problem in real estate: **chaotic maintenance tracking**. By moving away from scattered emails and text messages, Casca provides a unified digital hub that increases operational efficiency for landlords and improves satisfaction and retention for tenants. 

The application utilizes **PHP** for robust server-side processing, **MySQL** for relational data storage, and strict **Session-based authentication** to ensure secure, role-specific access to the platform.

---

## ✨ Features

### 👤 Tenant Portal
* **Secure Login:** Access the platform using registered credentials.
* **Frictionless Ticketing:** Easily raise maintenance or service requests.
* **Verified Identity:** Tickets are automatically linked to the logged-in tenant via session-stored emails (preventing anonymous spam).
* **Personalized Dashboard:** A clean UI focused purely on tenant needs.

### 🏢 Landlord Portal
* **Centralized Command Center:** A dedicated dashboard separate from tenants.
* **Request Management:** View, prioritize, and manage incoming maintenance tickets.
* **Property Oversight:** Maintain visibility over property health and tenant needs at a glance.

### 🔐 Security & System Architecture
* **Role-Based Access Control (RBAC):** Automatic redirection to appropriate dashboards based on user roles.
* **Session Management:** PHP sessions securely maintain authenticated user states.
* **Relational Integrity:** Strict MySQL Foreign Key relationships ensure every ticket belongs to a verified user.

---

## 🛠 Tech Stack

| Category | Technologies |
| :--- | :--- |
| **Frontend** | HTML5, CSS3, Vanilla JavaScript |
| **Backend** | PHP |
| **Database** | MySQL |
| **Server Environment** | XAMPP / WAMP (Apache) |
| **Icons & Styling** | Font Awesome, Custom CSS |

---

## 🗄️ Database Architecture

The system is built on a streamlined relational model to ensure accountability:

* **Users Table:** Stores credentials (`email` as Primary Key, `password`, `role`).
* **Tickets Table:** Stores maintenance requests (`ticket_id`, `description`, `email` as Foreign Key).

---

## 📂 Project Structure

```text
Casca/
│
├── assets/
│   ├── css/style.css
│   ├── js/script.js
│   └── img/
├── database/
│   └── casca_db.sql        # Import this file to setup your database
├── includes/
│   └── db_connect.php      # Database connection logic
├── index.php               # Landing Page
├── login.php               # Authentication handling
├── logout.php              # Session destruction
├── tenant_dashboard.php    # Tenant Portal & Ticket Submission
├── landlord_dashboard.php  # Landlord Portal & Ticket Management
├── README.md
└── LICENSE
