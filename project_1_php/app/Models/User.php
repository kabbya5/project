<?php 

namespace App\Models;

use App\Core\Database;
use App\Core\Model;
use PDO;


class User extends Model{
    protected $table = 'users';
    private $tokenClass;

    public function __construct(){
        parent::__construct();
        $this->pdo = Database::getConnection();
        $this->tokenClass = new Token();
    }
    
    public function create($data){
        
        if ($this->findByEmail($data['email'])) {
            return false;
        }

        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['password'] = $hash;

        $userId = parent::create($data);

        return $this->tokenClass->createToken($userId);
       
    }

    public function findByEmail(string $email): ? array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getUserByToken(string $token): ? array {
        $tokenClass = new Token();
        $userId = $tokenClass->verifyToken($token);
        if (!$userId) {
            return null;
        }
        return $this->findById($userId);
    }

}