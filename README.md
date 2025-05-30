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




  
