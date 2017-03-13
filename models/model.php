<?php
/**
 * Retourne le tableau des lettres disponibles pour jouer au pendu
 * avec leur statut, disponible ou pas pour constituer le select
 * qui permettra au joueur de proposer une lettre.
 *
 * @return array
 */
function getLettersArray()
{
    return [
        'a' => true,
        'b' => true,
        'c' => true,
        'd' => true,
        'e' => true,
        'f' => true,
        'g' => true,
        'h' => true,
        'i' => true,
        'j' => true,
        'k' => true,
        'l' => true,
        'm' => true,
        'n' => true,
        'o' => true,
        'p' => true,
        'q' => true,
        'r' => true,
        's' => true,
        't' => true,
        'u' => true,
        'v' => true,
        'w' => true,
        'x' => true,
        'y' => true,
        'z' => true,
    ];
}

/**
 * Retourne une chaîne encodant un truc à encoder
 *
 * @param array $toEncode Un truc à encoder
 *
 * @return string
 */
function encode($toEncode)
{
    return base64_encode(json_encode($toEncode));
}

/**
 * Retourne un array à partir de sa représentation
 * sous forme de chaîne
 *
 * @param string $toDecode La chaine qui représente l’array
 *
 * @return array
 */
function decode($toDecode)
{
    return json_decode(base64_decode($toDecode), true);
}

/**
 * Retourne l’array des mots depuis le fichier qui en contient la liste
 *
 * @return mixed
 */
function getWordsArray()
{
    return @file(SOURCE_NAME, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: false;
}

/**
 * Retourne un indice aléatoire du tableau des mots
 *
 * @param array $wordsArray Le tableau des mots
 *
 * @return integer
 */
function getRandomIndex($wordsArray)
{
    return rand(0, count($wordsArray) - 1);
}

/**
 * Retourne un mot du tableau des mots à partir de son indice
 *
 * @param array $wordsArray Le tableau des mots
 * @param integer $wordIndex L’indice du mot
 *
 * @return string
 */
function getWord($wordsArray, $wordIndex)
{
    return str_replace(' ', '', strtolower($wordsArray[$wordIndex]));
}

/**
 * Retourne la chaine de remplacement
 *
 * @param integer $lettersCount Le nombre de lettres du mot
 *
 * @return string
 */
function getReplacementString($lettersCount)
{
    return str_pad('', $lettersCount, REPLACEMENT_CHAR);
}
