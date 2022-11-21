<?php

include_once("functions.php");

$choix = strtolower(readline("Voulez-vous des valeurs par défauts (fichiers) ou des valeurs personnelles ? \n 
Tapez 'Y' pour valeur personnelles et valider juste sinon : "));

switch ($choix) {
    case 'y':
        do {

            echo("Veuillez bien renseigner la clé et le texte ! \n");    
            $cle = trim(strtoupper(readline("Entrer la clé : ")));
            $texte = trim(strtoupper(readline("Entrer votre texte : ")));
        
        } while ($cle == "" || $texte == "");

        echo("Forme crypté du texte : " . crypt_sentence($texte, $cle));

        break;
    
    default:
        $file_contents = trim(file_get_contents('texte'));
        if($file_contents != "")
        {
            $file_contents = explode(PHP_EOL, file_get_contents('texte'));
            foreach ($file_contents as $key => $value) {
            
                if(explode(": ", $value)[0] == "cle")
                {
                    $cle = strtoupper(explode(": ", $value)[1]);
                }
                else {
                    $texte = strtoupper(explode(": ", $value)[1]);
                }
                
            }
            
            file_put_contents(strtolower($cle) . '_crypteur_' . strtolower($texte), crypt_sentence($texte, $cle));
            echo("La forme crypté " . crypt_sentence($texte, $cle) . " a été ajouté dans le fichier " . strtolower($cle) . '_crypteur_' . strtolower($texte));
        }
    
        break;
}

?>

