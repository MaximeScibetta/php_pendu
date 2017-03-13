<?php
if(!isset($_COOKIE['game_data'])){
    die('OOps, vous devez supporter les cookies pour que le jeu fonctionne');
}

$game_data = decode($_COOKIE['game_data']);
extract($game_data);

/**
 * Un indicateur booléen du fait que le mot a été trouvé ou pas
 *
 * @var boolean
 */
$wordFound = false;

/**
 * Le mot à trouver
 *
 * @var string
 */
$word = getWord($wordsArray, $wordIndex);

/**
 * le nombre de lettres du mot
 *
 * @var int
 */
$lettersCount = strlen($word);

/**
 * La lettre qui vient d’être essayée
 *
 * @var string
 */
$triedLetter = $_POST['triedLetter'];

$triedLetters .= $triedLetter;
// Modification de la chaîne des lettres déjà essayées
// en y ajoutant la nouvelle essayée par le joueur

$lettersArray[$triedLetter] = false;
// Modification du statut de la lettre qui vient d’être essayée.
// Son statut est mis à false dans le tableau $lettersArray

$letterFound = false;
for ($i = 0; $i < $lettersCount; $i++) {
    $l = substr($word, $i, 1);
    if($triedLetter === $l){
        $letterFound = true;
        $replacementString = substr_replace($replacementString,$l,$i,1);
    }
}
if(!$letterFound){
    $trials++;
}else{
    if($word === $replacementString){
        $wordFound = true;
    }
}
$remainingTrials = MAX_TRIALS - $trials;
setcookie('game_data',encode(compact('trials','triedLetters','wordIndex','replacementString','lettersArray')));
