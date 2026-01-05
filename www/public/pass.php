<?php
$hash = password_hash("azerty",
    PASSWORD_DEFAULT, ['cost' => 12]);

echo $hash;