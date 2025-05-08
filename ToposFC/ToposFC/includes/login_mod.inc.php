<?php
declare(strict_types=1);
function get_user(object $pdo,string $user){
    $query = "SELECT * FROM topos_admins WHERE usuario= :user;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user",$user);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}