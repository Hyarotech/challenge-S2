<?php
namespace App\Controllers;

function deleteUser($userId)
    {
        // Supprimer l'utilisateur avec l'ID fourni de la base de données
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $userId);

        if ($stmt->execute()) {
            // Succès de la suppression
            return true;
        } else {
            // Échec de la suppression
            return false;
        }
    }