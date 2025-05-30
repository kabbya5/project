# Pure php project 1
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
      

- **Register**
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
    ```

- **Login**
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
---
