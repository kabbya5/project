
# Freelance Time Tracker API
### Auth 

**Register**
  - **Method:** POST  
  - **Endpoint:** `/api/register`  
  - **Request Body (JSON):**
     ``` json
     {
        "name": "Alice",
        "email": "alice@example.com",
        "password": "password1",
    }
     
    ```

**Login**
  - **Method:** POST  
  - **Endpoint:** `api/login`  
  - **Request Body (JSON):**
    ```json
     {
      "email": "alice@example.com",
      "password": "password1"
    }
  ```
### Authorization: Bearer sanctum_token

**Logout**
  - **Method:** POST  
  - **Endpoint:** `api/logout`
  - Authorization type  Bearer
  - Header key: Authorization, value: sanctum_token
### Time Log
** Filter by week/ day  **
  - **Method:** GET
  - **Endpoint:** `api/time-logs`  
  - **Request Body (JSON):**
    ```json
    {
        "date": "2025-05-27",
        "type": "week" // day
    }
  ```

** Time log Pdf **
  - **Method:** GET
  - **Endpoint:** `api/time-log/generate/pdf`  
  - **Request Body (JSON):**
    {
        "client_id":"1",
        "from_date":"2025-05-12",
        "to_date":"2025-05-12"
    }
  ```
** Store **
  - **Method:** POST  
  - **Endpoint:** `api/time-logs/start`  
  - **Request Body (JSON):**
    ```json
     {
        "project_id": 1,
        "tag": "billable",
        "start_time": "2025-05-28 09:00:00",
        "description": "Worked on frontend module for client dashboard.",
    }
  ```
** Update **
  - **Method:** PUT  
  - **Endpoint:** `api/time-logs/update/{time_log}`  
  - **Request Body (JSON):**
    ```json
     {
          "project_id": 1,
          "tag": "billable",
          "start_time": "2025-05-28 09:00:00",
          "description": "Worked on frontend module for client dashboard.",
          "end_time": "2025-05-28 17:30:00",
      }
  ```


# Mini Support Ticketing System
### Project Stucture 
- app
  - Controllers
      - AuthController ( register, login, logout(AuthMiddleware))
      - Department Controler (Crud (AdminMiddleware))
      - Ticket Controller (Crud, (AgentMiddleware))
  - Core
      - Databaase.php (database connection)
      - Model.php (common sql like create, edit, update, delete)
      - Router.php ( Handel method, dispatch, Middlewar)
  - Middlewars
      - Admin Middlewar
      - AuthMiddlewar 
      - AgentMiddleware
  - Model
      - Department.php
      - Ticket.php
      - Token.php
      - User.php
  
- helpres
  - helpers.php (file upload system)
- routes
  - api.php 
- sql
  - schema.sql ( only table)
- htaccess
- composer.json
- config.php
- index.php 
      
### Auth 

**Register**
  - **Method:** POST  
  - **Endpoint:** `/register`  
  - **Request Body (JSON):**
     ```json
    {
      "name": "Alice",
      "email": "alice@example.com",
      "password": "password1",
      "role": "user"
    }

    {
        "name": "Admin",
        "email": "admin@example.com",
        "password": "password1"
        "role": "admin"
    }

    {
        "name": "Agent",
        "email": "agent@example.com",
        "password": "password1",
        "role": "agent"
    }
        
    ```
    ```

**Login**
  - **Method:** POST  
  - **Endpoint:** `/login`  
  - **Request Body (JSON):**
    ```json
    {
      "email": "alice@example.com",
      "password": "password1"
    }
  "email": "alice@example.com",
  "password": "password1"
}

**Logout**
  - **Method:** POST  
  - **Endpoint:** `/logout`
  - Authorization type  none
  - Header key:Authorization, value: login / register token

## Department 

### Store
- **Method:** POST  
- **Endpoint:** `/departments`  
- **Request Body (JSON):**
  ```json
  { "name": "Software Development"}
  { "name": "Technical Support" }
  { "name": "IT Operations" }
  ```

### Update
- **Method:** PUT  
- **Endpoint:** `/departments/{id}`  
- **Request Body (JSON):**
```json
 { "name": "Software Development update"}
```
### Delete
- **Method:** DELETE
- **Endpoint:** `/departments/{id}`
## Ticket
**Store**
- **Method:** POST
- **Endpoint:** `/tickets`  
- **Request Body (JSON):**
```json
 {
    "title": "Cannot login to account",
    "description": "I am unable to login since yesterday.",
    "department_id": 1
    "attachment" : "file path",
  }
```
### Update status 
- **Method:** PUT
- **Endpoint:** `/tickets/{id}/status`
--- json

  {"status":"in_progress"}
---
### Add Note
- **Method:** PUT
- **Endpoint:** `tickets/{id}/notes`
``` json
{"Note":"note details"}
```
   






  
