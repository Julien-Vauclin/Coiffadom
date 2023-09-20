<?php
class User
{
    private string $lastname;
    private string $firstname;
    private string $mail;
    private string $phone;
    private string $password;
    private string $passwordConfirm;

    public static function getInfosUser(string $mail)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM user WHERE mail = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mail]);

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                // Aucun résultat trouvé pour l'adresse e-mail
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des informations de l'employé : " . $exception->getMessage();
            return false;
        }
    }
}
