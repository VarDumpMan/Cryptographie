<?php

/**
 * Fonction de deboggage
 */

// Fonction pour afficher le contenu des variables (debug function)
function dump($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}


/**
 * Fonction pour le système de cryptage
 */

// Fonction permet d'ajouter dans un tableau des lettres suivant des valeurs du code ascii envoyés.
function push(&$tableau, $debut, $fin) {

    for ($i=$debut; $i <= $fin; $i++) { 
        array_push($tableau, chr($i));
    }
    
}

// Fonction qui génère des lettres de l'alphabet suivant une plage de valeur ASCII
function alphabet($debut, $fin) {
    $lettres = [];
    if($debut==65 && $fin==90) {
        push($lettres, $debut, $fin);
    }
    elseif ($debut > 65) {
        push($lettres, $debut, $fin);
        push($lettres, 65, $debut-1);
    } 
    return $lettres;
}

// Fonction permettant de crypter un mot suivant une clé 

function crypt_text($texte, $cle) : string {
    $lettre_equivalente = "";

    for($l = 0; $l<strlen($texte); $l+=strlen($cle)) 
    {
        $sous_texte = str_split(substr($texte, $l, strlen($cle)));
        foreach($sous_texte as $key => $value)
        {
            // récupérer la position de la lettre dans l'alphabet
            $position = array_keys(alphabet(65, 90), $value)[0];

            // récupérer la lettre correspondante suivant la clé
            $lettre_equivalente = $lettre_equivalente . alphabet(ord($cle[$key]), 90)[$position];
        }
    }
    
    return strtolower($lettre_equivalente);
}

// Fonction permettant de crypter une phrase suivant une clé

function crypt_sentence($sentence, $key)
{
    if(str_word_count($sentence) == 1)
    {
        $crypt_sentence = crypt_text($sentence, $key);
    }
    else {
        $sentence_words = explode(" ", $sentence);
        $sentence_nospace = implode($sentence_words);
        
        // cryptage de la phrase
        $crypt_sentence_nospace = crypt_text($sentence_nospace, $key);

        // regroupement dans un tableau de chaque mot crypté de la phrase
        $k = 0;
        $crypt_sentence = [];
        foreach ($sentence_words as $value) {
            array_push($crypt_sentence, substr($crypt_sentence_nospace, $k, strlen($value)));
            $k+= strlen($value);
        }

        $crypt_sentence = implode(" ", $crypt_sentence);
    }   

    return $crypt_sentence;
}

?> 