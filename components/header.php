<?php

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../functions.php';

$allowedThemes = ['light', 'dark'];

$theme = isset($_COOKIE['theme'])
    ? $_COOKIE['theme']
    : 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

$cartCount = cartCount($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e(isset($title) ? $title : 'Keranjang Belanja') ?></title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            transition: 0.3s;
        }

        body.dark {
            background: #0f172a;
            color: #e2e8f0;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: auto;
        }

        .navbar {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            padding: 18px 25px;
            margin-top: 25px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar h1 {
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.15);
            padding: 10px 15px;
            border-radius: 8px;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.25);
        }

        .content {
            margin-top: 25px;
        }

        .flash {
            padding: 15px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
            border-left: 5px solid #22c55e;
        }

        body.dark .flash {
            background: #14532d;
            color: #dcfce7;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .produk-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        body.dark .produk-card {
            background: #1e293b;
        }

        .produk-icon {
            font-size: 50px;
            text-align: center;
            margin-bottom: 15px;
        }

        .produk-card h2 {
            margin: 10px 0;
        }

        .harga {
            color: #2563eb;
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0;
        }

        body.dark .harga {
            color: #60a5fa;
        }

        .btn {
            border: none;
            cursor: pointer;
            padding: 11px 16px;
            border-radius: 8px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            overflow-x: auto;
        }

        body.dark .table-container {
            background: #1e293b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        body.dark th,
        body.dark td {
            border-bottom-color: #334155;
        }

        .total {
            text-align: right;
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
        }

        .empty {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 15px;
        }

        body.dark .empty {
            background: #1e293b;
        }

        footer {
            text-align: center;
            padding: 30px;
            margin-top: 30px;
        }

        @media (max-width: 800px) {

            .produk-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

        }

    </style>

</head>

<body class="<?= e($theme) ?>">

<div class="container">

    <div class="navbar">

        <h1>🛒 Keranjang Belanja</h1>

        <div class="nav-links">

            <a href="index.php">
                Produk
            </a>

            <a href="cart.php">
                Keranjang (<?= $cartCount ?>)
            </a>

        </div>

    </div>

    <div class="content">