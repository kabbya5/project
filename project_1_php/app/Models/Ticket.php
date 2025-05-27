<?php 
namespace App\Models;
use App\Core\Model;

class Ticket extends Model{
    protected $table = 'tickets'; 

    public function assignToAgent($ticketId, $agentId) {
        $stmt = $this->pdo->prepare("UPDATE tickets SET agent_id = ? WHERE id = ?");
        $stmt->execute([$agentId, $ticketId]);
    }

    public function updateStatus($ticketId, $status) {
        $stmt = $this->pdo->prepare("UPDATE tickets SET status = ? WHERE id = ?");
        $stmt->execute([$status, $ticketId]);
    }

    public function addAttachment($ticketId, $path) {
        $stmt = $this->pdo->prepare("INSERT INTO ticket_attachments (ticket_id, file_path) VALUES (?, ?)");
        $stmt->execute([$ticketId, $path]);
    }

    public function addNote($data){
        $this->table = 'ticket_notes';

        $this->create($data);
    }
}