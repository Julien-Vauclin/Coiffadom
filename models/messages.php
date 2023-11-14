<?php
class Message
{
    private string $MESSAGE_ID;
    private string $MESSAGE_USER_ID;
    private string $MESSAGE_CONTENT;
    private string $MESSAGE_DATE;
    private string $MESSAGE_TIME;
    private string $MESSAGE_RECIPIENT_ID;
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
            $sql = "SELECT * FROM messages 
            INNER JOIN user
            ON `MESSAGE_USER_ID` = `ID`
            WHERE MESSAGE_RECIPIENT_ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userId]);
            if ($stmt->rowCount() > 0) {
                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $messages;
            } else {
                return [];
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des messages : " . $exception->getMessage();
            return [];
        }
    }
    // Fonction qui récupère les messages envoyés par l'utilisateur
    public static function getSentMessagesByUserId(int $userId)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM messages WHERE MESSAGE_USER_ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userId]);
            if ($stmt->rowCount() > 0) {
                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $messages;
            } else {
                return [];
            }
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
    // Fonction pour compter les messages reçus
    public static function countMessages()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT COUNT(*) as total_messages FROM messages";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $messages = $stmt->fetch(PDO::FETCH_ASSOC);
                return $messages['total_messages'];
            } else {
                return [];
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des messages : " . $exception->getMessage();
            return [];
        }
    }
    // Fonction qui permet d'envoyer un message a un utilisateur en fonction de son ID
    public static function sendMessageToUser(int $userId, string $messageContent, int $messageRecipientId)
    {
        try {
            $pdo = Database::createInstancePDO();
            $actualDate = date("Y/m/d");
            $actualTime = date("H:i");
            $newTime = new DateTime($actualTime);
            $newTime->add(new DateInterval('PT1H'));
            $newTimePlusTwo = $newTime->format("H:i");
            $sql = "INSERT INTO messages (MESSAGE_USER_ID, MESSAGE_CONTENT, MESSAGE_DATE, MESSAGE_TIME, MESSAGE_RECIPIENT_ID) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userId, $messageContent, $actualDate, $newTimePlusTwo, $messageRecipientId]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de l'envoi du message : " . $exception->getMessage();
            return false;
        }
    }
}
