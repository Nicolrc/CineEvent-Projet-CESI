<?php
$panier =
    [
        "Livre" => 50,
        "Tomate" => 43,
        "Diplome" => 540,
    ];

setcookie("panier", json_encode($panier), time() + (86400 * 30), "/");