<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: index.php');
    exit;

}

$action = isset($_POST['action'])
    ? $_POST['action']
    : '';

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

/*
|--------------------------------------------------------------------------
| Tambah Produk
|--------------------------------------------------------------------------
*/

if (
    $action === 'add' &&
    $id !== false &&
    $id !== null &&
    isset($products[$id])
) {

    if (isset($_SESSION['cart'][$id])) {

        $_SESSION['cart'][$id]++;

    } else {

        $_SESSION['cart'][$id] = 1;

    }

    setFlash('Produk berhasil ditambahkan ke keranjang.');

    header('Location: index.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Hapus Produk
|--------------------------------------------------------------------------
*/

if (
    $action === 'remove' &&
    $id !== false &&
    $id !== null &&
    isset($_SESSION['cart'][$id])
) {

    unset($_SESSION['cart'][$id]);

    setFlash('Produk berhasil dihapus dari keranjang.');

    header('Location: cart.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Kosongkan Keranjang
|--------------------------------------------------------------------------
*/

if ($action === 'clear') {

    $_SESSION['cart'] = [];

    setFlash('Keranjang berhasil dikosongkan.');

    header('Location: cart.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Request Tidak Valid
|--------------------------------------------------------------------------
*/

setFlash('Permintaan tidak valid.');

header('Location: index.php');
exit;