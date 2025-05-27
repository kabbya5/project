<?php 

namespace App\Controllers\Api;
use App\Models\Ticket;
use App\Middlewares\AgentMiddleware;

class TicketController{
    
    private $middleware;
    private $model;

    public function __construct()
    {
        $this->middleware = new AgentMiddleware();
        $this->model = new Ticket();
    }


    public function submitTicket(){
        $data = json_decode(file_get_contents('php://input'),true);
        if(!$data){
            $data['title'] = $_POST['title'] ?? '';
            $data['department_id'] = $_POST['department_id'] ?? '';
            $data['description'] = $_POST['description'] ?? '';
        }

        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Title is required.';
        }elseif (strlen($data['title']) > 255) {
            $errors['title'] = 'Title must not exceed 255 characters.';
        }

        if (empty($data['department_id'])) {
            $errors['department_id'] = 'Department ID is required.';
        }elseif (!is_numeric($data['department_id'])) {
            $errors['department_id'] = 'Department ID must be a number.';
        }

        if (empty($data['description'])) {
            $errors['description'] = 'Description is required.';
        }elseif (strlen($data['description']) < 10) {
            $errors['description'] = 'Description must be at least 10 characters.';
        }

        if (!empty($errors)) {
            header('Content-Type: application/json');
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            exit;
        }

        $ticketId =  $this->model->create($data);

         if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $path = uploadFile($_FILES['attachment'], $path = 'Tickets');
            $this->model->addAttachment($ticketId, $path);
        }

        return $this->model->find($ticketId);
    }

    public function assignAgent($id){

        $user = $this->middleware->handle();
        $this->model->assignToAgent($id, $user['id']);
    }

    public function changeStatus($id){
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['status'])) {
            http_response_code(422);
            echo json_encode(['errors' => 'Status is required.']);
            exit;
        }

        $this->model->updateStatus($id, $data['status']);
    }

    public function addNote($id){
        $data = json_decode(file_get_contents('php://input'), true);
        $user = $this->middleware->handle();
        $data['user_id'] = $user['id'];
        $data['ticket_id'] = $id;

        $this->model->addNote($data);
    }
}