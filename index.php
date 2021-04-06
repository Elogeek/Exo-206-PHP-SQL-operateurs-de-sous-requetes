<?php
require_once "DB/DB.php";
/**
 * Commencez par importer le fichier sql live.sql via PHPMyAdmin.
 * 1. Sélectionnez tous les utilisateurs.
 * 2. Sélectionnez tous les articles.
 * 3. Sélectionnez tous les utilisateurs qui parlent de poterie dans un article.
 * 4. Sélectionnez tous les utilisateurs ayant au moins écrit deux articles.
 * 5. Sélectionnez l'utilisateur Jane uniquement s'il elle a écris un article ( le résultat devrait être vide ! ).
 *
 * ( PS: Sélectionnez, mais affichez le résultat à chaque fois ! ).
 */
$request = DB::getInstance()->prepare("SELECT * FROM user");

if($request->execute()) {
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";
}

$request = DB::getInstance()->prepare("SELECT * FROM article");

if($request->execute()) {
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";
}

$request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = ANY (SELECT user_fk FROM article WHERE contenu LIKE '%poterie%')");

if($request->execute()) {
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";
}

$request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = ANY (SELECT user_fk FROM article HAVING COUNT(user_fk) >= 2)");

if($request->execute()) {
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";
}

$request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = exists (SELECT user_fk FROM article)");

if($request->execute()) {
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";
}