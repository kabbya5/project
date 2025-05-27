<?php 

namespace APP\Models;

class Token 
{
    private $filePath;
    private $tokens;

    public function __construct(){
        $this->filePath = __DIR__ . "/../../storage/tokens.json";
        if(!file_exists($this->filePath)){
            file_put_contents($this->filePath, json_encode([]));
        }
        $this->tokens = json_decode(file_get_contents($this->filePath), true);
    }

    
    public function createToken(int $userId): string {
        $token = bin2hex(random_bytes(16));
        $this->tokens[$token] = ['user_id' => $userId, 'created_at' => time()];
        file_put_contents($this->filePath, json_encode($this->tokens)) !== false;
        return $token;
    }

    public function verifyToken(string $token): int {

        if (!isset($this->tokens[$token])) {
            http_response_code(401);
            echo json_encode(['error' => "Token not found."]);
            exit;
        }

        $tokenData = $this->tokens[$token];

        // 30 days expiry
        $expire_time = 60 * 60 * 24 * 30;

          if ($tokenData['created_at'] > time()) {
            return false;
        }

        if ((time() - $tokenData['created_at']) > $expire_time) {
            return false;
        }

        return $tokenData['user_id'];
    }

    public function delete(string $token):bool{
        if(isset($this->tokens[$token])){
            unset($this->tokens[$token]);
            return file_put_contents($this->filePath, json_encode($this->tokens)) !== false;
        }

        return false;
    }
}