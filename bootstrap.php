<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['flash'])) {
    $_SESSION['flash'] = null;
}