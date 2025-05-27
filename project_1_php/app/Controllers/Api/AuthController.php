<?php 

namespace App\Controllers\Api;

use App\Models\User;

class AuthController{
    public function register(){
        $data = json_decode(file_get_contents('php://input'),true);

        if(empty($data['name']) || empty($data['email']) || empty($data['password'])){
            http_response_code(400);
           echo json_encode(['error' => 'Name, email and password are required']);
           exit;
        }

        $userModel = new User();

        $token = $userModel->create($data);

        if(!$token){
            http_response_code(400);
            return json_encode(['error' => "Email alreay exist"]);
            exit;
        }

        http_response_code(201);
        echo json_encode([
            'message' => 'User registered successfully',
            'token' => $token
        ]);
        exit;
    }

    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            return ['error' => 'Email and password are required'];
        }

        $userModel = new User();
        $user = $userModel->findByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user['password'])) {
            http_response_code(401);
            return ['error' => 'Invalid credentials'];
        }

        $tokenModel = new \APP\Models\Token();
        $token = $tokenModel->createToken($user['id'], $user['email']);

        return ['message' => 'Login successful', 'token' => $token];
    }

    public function logout()
    {
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? null;

        if (!$token) {
            http_response_code(400);
            return ['error' => 'Token required for logout'];
        }

        $tokenModel = new \APP\Models\Token();
        $deleted = $tokenModel->delete($token);

        if ($deleted) {
            return ['message' => 'Logged out successfully'];
        } else {
            http_response_code(400);
            return ['error' => 'Invalid token or already logged out'];
        }
    }
    
}