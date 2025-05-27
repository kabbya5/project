<?php

namespace App\Middlewares;

use App\Models\User;

class AdminMiddleware {
    public function handle(): ?array {
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? null;

        if (!$token) {
            http_response_code(401);
            echo json_encode(['error' => 'Authorization token not found.']);
            exit;
        }

        $userModel = new User();
        $user = $userModel->getUserByToken($token);

        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid or expired token']);
            exit;
        }

        if (!isset($user['role']) || $user['role'] != 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied. Admins only handel this url.']);
            exit;
        }

        return $user;
    }
}