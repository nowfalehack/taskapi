# Task Management REST API

A simple RESTful API built using Laravel 12 for managing tasks.

## Features
- Create a task
- Retrieve all tasks
- Retrieve a single task
- Update a task
- Delete a task
- Input validation
- Standardized JSON responses
- HTTP status codes for success and errors

## Technologies
- Laravel 12
- PHP
- MySQL / SQLite
- REST API
- Postman

## Installation

1. Clone the repository.
2. Install dependencies:

   ```bash
   composer install
   ```

3. Configure your database in `.env`.

4. Generate application key:

   ```bash
   php artisan key:generate
   ```

5. Run migrations:

   ```bash
   php artisan migrate
   ```

6. Start the server:

   ```bash
   php artisan serve
   ```

## API Endpoints

| Method | Endpoint | Description |
|---|---|---|
| POST | /api/tasks | Create task |
| GET | /api/tasks | Get all tasks |
| GET | /api/tasks/{id} | Get single task |
| PUT | /api/tasks/{id} | Update task |
| PATCH | /api/tasks/{id} | Partially update task |
| DELETE | /api/tasks/{id} | Delete task |

## Task Fields

- id: Auto-increment primary key
- title: Required string
- description: Optional text
- status: pending or completed
- due_date: Optional date
- created_at: Timestamp
- updated_at: Timestamp

## Validation

The API validates required fields and ensures status is either pending or completed.

## Testing

All API endpoints can be tested using Postman.
