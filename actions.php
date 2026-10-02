<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';


/*
|--------------------------------------------------------------------------
| Hanya menerima POST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    setFlash('Metode request tidak valid.');

    header('Location: index.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| Validasi Action
|--------------------------------------------------------------------------
*/

$allowedActions = [
    'add',
    'remove',
    'clear'
];

$action = isset($_POST['action'])
    ? $_POST['action']
    : '';

if (!in_array($action, $allowedActions, true)) {

    setFlash('Aksi tidak valid.');

    header('Location: index.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| Tambah Produk
|--------------------------------------------------------------------------
*/

if ($action === 'add') {

    $id = filter_input(
        INPUT_POST,
        'id',
        FILTER_VALIDATE_INT
    );

    if (
        $id === false ||
        $id === null ||
        !isset($products[$id])
    ) {

        setFlash('Produk tidak valid.');

        header('Location: index.php');
        exit;
    }


    if (isset($_SESSION['cart'][$id])) {

        $_SESSION['cart'][$id]++;

    } else {

        $_SESSION['cart'][$id] = 1;

    }

    setFlash(
        'Produk berhasil ditambahkan ke keranjang.'
    );

    header('Location: index.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| Hapus Produk
|--------------------------------------------------------------------------
*/

if ($action === 'remove') {

    $id = filter_input(
        INPUT_POST,
        'id',
        FILTER_VALIDATE_INT
    );

    if (
        $id === false ||
        $id === null
    ) {

        setFlash('ID produk tidak valid.');

        header('Location: cart.php');
        exit;
    }


    if (isset($_SESSION['cart'][$id])) {

        unset($_SESSION['cart'][$id]);

        setFlash(
            'Produk berhasil dihapus dari keranjang.'
        );

    } else {

        setFlash(
            'Produk tidak ditemukan di keranjang.'
        );
    }

    header('Location: cart.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| Kosongkan Keranjang
|--------------------------------------------------------------------------
*/

if ($action === 'clear') {

    if (!empty($_SESSION['cart'])) {

        $_SESSION['cart'] = [];

        setFlash(
            'Keranjang berhasil dikosongkan.'
        );

    } else {

        setFlash(
            'Keranjang sudah kosong.'
        );
    }

    header('Location: cart.php');
    exit;
}