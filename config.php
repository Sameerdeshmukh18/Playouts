<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51L9MF5SHKWkSjTtTc7n0XtwurxulobwMFjQ04MKRk3KHeRPWwZYlbCYZ1MuQZbEgxom5P5b0I4iswdCI0sPoJ4a10050ZbrRBd";

$secretKey="sk_test_51L9MF5SHKWkSjTtTGDBoPns2O2qGB1OeUzVUNSqpAvlQkyCnDGD0HoBrXvyxQVDiUN5CeCHw5hghdqD5ISvMZeTu00mnDr4G61";

\Stripe\Stripe::setApiKey($secretKey);
?>