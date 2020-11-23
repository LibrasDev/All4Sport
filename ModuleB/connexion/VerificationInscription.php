<?php
class VerificationInscription
{
    public static function startVerification($nomUtilisateur, $mail, $mail2, $mdp, $mdp2, $nom, $adresse)
    {
        $tableau = array(
            htmlspecialchars($nomUtilisateur), 
            htmlspecialchars($mail),
            htmlspecialchars($mail2),
            htmlspecialchars($mdp),
            htmlspecialchars($mdp2)
        );
        if(self::verifierTailleChaineDeCaractere(strlen($nomUtilisateur), strlen($mail), strlen($mdp), strlen($nom), strlen($adresse)))
        {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                if($tableau[1] == $tableau[2] && $tableau[3] == $tableau[4])
                {
                    include "../../BDD/Database.php";
                    $connexion = Database::connect();
                    $execution = $connexion->prepare("SELECT ut_surnom FROM utilisateur WHERE ut_email=\"" . $mail . "\";");
                    $execution->execute();
                    $reqmail = $execution->fetchall();
                    if(!isset($reqmail["nomUtilisateur"]))
                    {
                        $execution = $connexion->prepare("INSERT INTO utilisateur (ut_surnom, ut_email, ut_mdp, ut_nom, ut_adresse) VALUES(\"" . $nomUtilisateur . "\",\"" . $mail . "\", \"" . $mdp . "\",\"" . $nom . "\",\"" . $adresse . "\");");
                        $execution->execute();
                        $reqmail = $execution->fetchall();
                        $connexion = null;
                        Database::disconnect();
                        return "L'inscription a été correctement enregistré !";
                    }
                    else
                    {
                        return "L'adresse mail ou le nom d'utilisateur est déjà utilisée !";
                    }
                }
                else
                {
                    return "Vos adresses mail ou vos mots de passes ne correspondent pas !";
                }
            }
            else
            {
                return "Votre adresse mail n'est pas valide";
            }
        }
        else
        {
            return "Votre nom ne doit pas dépasser 255 caractères.";
        }
    }

    private static function verifierTailleChaineDeCaractere($nomUtilisateur, $mail, $motDePasse, $nom, $adresse)
    {
        if($nomUtilisateur > 255 || $mail > 255 || $motDePasse > 255 || $nom > 255 || $adresse > 255)
        {
            return false;
        }
        return true;
    }
}
?>