# 🎮 GameBlog - PHP MVC Video Game Blog

A modern, full-stack video game blog built with **PHP 8.2**, **MySQL**, and **TailwindCSS**. This project features a custom MVC architecture, role-based authentication, a Retrieval-Augmented Generation (RAG) AI assistant, and n8n webhook integration.

![GameBlog Screenshot](https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=2070&auto=format&fit=crop)

## ✨ Features

- **MVC Architecture**: Custom-built lightweight framework.
- **Authentication**: Secure login/registration with hashed passwords.
- **Role-Based Access Control (RBAC)**:
  - **Admin**: Full control (Manage Users, Posts, Comments).
  - **Writer**: Create and manage own posts.
  - **Subscriber**: Read and comment.
- **Modern UI**: "Gaming" aesthetic with Dark Mode, built with **TailwindCSS v4**.
- **AI Assistant (RAG)**: Ask questions about blog content and get context-aware answers.
- **Webhooks**: Integration with **n8n** for event notifications (New Post, New Comment).
- **Dockerized**: Full stack (App, DB, n8n, phpMyAdmin) ready to run with Docker Compose.

## 🚀 Getting Started

### Prerequisites

- Docker & Docker Compose

### Installation

1.  **Clone the repository**

    ```bash
    git clone <repository-url>
    cd gameblog
    ```

2.  **Start the containers**

    ```bash
    docker compose up -d
    ```

3.  **Initialize Seed Data** (Optional but recommended)
    Run the following commands to populate the database with users and posts:

    ```bash
    docker exec mvc_app php scripts/create_seed_users.php
    docker exec mvc_app php scripts/create_seed_posts.php
    docker exec mvc_app php scripts/create_seed_comments.php
    ```

4.  **Access the Application**
    - **Web App**: [http://localhost:8080](http://localhost:8080)
    - **phpMyAdmin**: [http://localhost:8081](http://localhost:8081) (User: `user`, Pass: `user_password`)
    - **n8n**: [http://localhost:5678](http://localhost:5678) (User: `admin`, Pass: `admin123`)

## 👤 Default Users

| Role           | Email                | Password     |
| :------------- | :------------------- | :----------- |
| **Admin**      | `admin@example.com`  | `Admin123!`  |
| **Writer**     | `writer@example.com` | `Writer123!` |
| **Subscriber** | `user@example.com`   | `User123!`   |

## 🛠️ Tech Stack

- **Backend**: PHP 8.2 (PDO, OOP)
- **Frontend**: HTML5, TailwindCSS
- **Database**: MySQL 8.0
- **DevOps**: Docker, Docker Compose
- **Automation**: n8n (Webhooks)

## 📂 Project Structure

```
├── config/             # Database connection
├── controllers/        # Request handlers (Auth, Post, Admin, etc.)
├── models/             # Data access layer
├── public/             # Static assets (CSS, JS)
├── scripts/            # Seed scripts
├── utils/              # Helpers (HttpClient, LLM)
├── views/              # HTML Templates
├── database.sql        # Database Schema
├── docker-compose.yml  # Container Orchestration
└── index.php           # Entry Point (Router)
```

---

Built for Gamers. 🕹️
