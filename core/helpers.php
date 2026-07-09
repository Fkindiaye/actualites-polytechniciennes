<?php

function tronquer(string $texte, int $longueur = 250): string
{
    $texte = strip_tags($texte);
    if (mb_strlen($texte) <= $longueur) {
        return $texte;
    }
    $texte = mb_substr($texte, 0, $longueur);
    $texte = mb_substr($texte, 0, mb_strrpos($texte, ' '));
    return $texte . '...';
}

function formaterDate(string $date): string
{
    $mois = [
        1 => 'janvier', 2 => 'fevrier', 3 => 'mars', 4 => 'avril',
        5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'aout',
        9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'decembre'
    ];
    $timestamp = strtotime($date);
    return date('d', $timestamp) . ' ' . $mois[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}
