<?php 

namespace App\Controllers\Api;

use App\Models\Department;

class DepartmentController{
    private $model;

    public function __construct(){
        $this->model = new Department();
    }

    public function store(){
        $data = json_decode(file_get_contents('php://input'),true);

        if(empty($data['name'])){
            http_response_code(400);
           echo json_encode(['error' => 'Department are required']);
           exit;
        }

        $id = $this->model->create($data);

        $data = $this->model->find($id);

        return $data;

    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'),true);

        if(empty($data['name'])){
            http_response_code(400);
           echo json_encode(['error' => 'Department are required']);
           exit;
        }

        $updatedId = $this->model->update($id, $data);

        $data = $this->model->find($id);

        return $data;
    }

    public function destroy($id){
        $this->model->delete($id);
        return TRUE;
    }
}