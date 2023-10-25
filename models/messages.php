<?php
class Message
{
    public static function sendMessage(int $userId, string $messageContent)
    {
        try {
            $pdo = Database::createInstancePDO();

            // Préparez la requête SQL d'insertion
            $sql = "INSERT INTO messages (MESSAGE_USER_ID, MESSAGE_CONTENT) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);

            // Exécutez la requête en passant les valeurs en tant que tableau
            $stmt->execute([$userId, $messageContent]);

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
    // fonction pour récupérer les messages d'un utilisateur
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
}
