<?php
class Message
{
    // Fonction pour envoyer un message
    public static function sendMessage(int $userId, string $messageContent)
    {
        try {
            $pdo = Database::createInstancePDO();
            $actualDate = date("Y/m/d");
            $actualTime = date("H:i");
            $newTime = new DateTime($actualTime);
            $newTime->add(new DateInterval('PT1H'));
            $newTimePlusTwo = $newTime->format("H:i");
            // Préparez la requête SQL d'insertion
            $sql = "INSERT INTO messages (MESSAGE_USER_ID, MESSAGE_CONTENT, MESSAGE_DATE, MESSAGE_TIME) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            // Exécutez la requête en passant les valeurs en tant que tableau
            $stmt->execute([$userId, $messageContent, $actualDate, $newTimePlusTwo]);

            // Vérifiez si l'insertion a réussi
            if ($stmt->rowCount() > 0) {
                return true; // Succès de l'insertion
            } else {
                return false; // Échec de l'insertion
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de l'envoi du message : " . $exception->getMessage();
            return false;
        }
    }
    // Fonction pour récupérer les messages d'un utilisateur
    public static function getMessagesByUserId(int $userId)
    {
        try {
            $pdo = Database::createInstancePDO();
            // Préparez la requête SQL de sélection
            $sql = "SELECT * FROM messages WHERE MESSAGE_USER_ID = ?";
            $stmt = $pdo->prepare($sql);
            // Exécutez la requête en passant les valeurs en tant que tableau
            $stmt->execute([$userId]);
            // Récupérez les résultats de la requête
            $messages = $stmt->fetchAll();
            // Retournez les résultats
            return $messages;
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des messages : " . $exception->getMessage();
            return [];
        }
    }
    // Fonction pour supprimer un message
    public static function deleteMessage(int $messageId)
    {
        try {
            $pdo = Database::createInstancePDO();
            // Préparez la requête SQL pour supprimer le message par son ID
            $sql = "DELETE FROM messages WHERE MESSAGE_ID = ?";
            $stmt = $pdo->prepare($sql);
            // Exécutez la requête en passant l'ID du message
            $stmt->execute([$messageId]);

            // Vérifiez si la suppression a réussi
            return $stmt->rowCount() > 0; // Renvoie true si un message a été supprimé
        } catch (PDOException $exception) {
            echo "Erreur lors de la suppression du message : " . $exception->getMessage();
            return false;
        }
    }
}
