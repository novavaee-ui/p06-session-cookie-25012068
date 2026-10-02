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

    header('Location: index.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| Ambil action
|--------------------------------------------------------------------------
*/

$action = isset($_POST['action'])
    ? $_POST['action']
    : '';


/*
|--------------------------------------------------------------------------
| Ambil ID Produk
|--------------------------------------------------------------------------
*/

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

    if (
        $id !== false &&
        $id !== null &&
        isset($_SESSION['cart'][$id])
    ) {

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


/*
|--------------------------------------------------------------------------
| Action Tidak Valid
|--------------------------------------------------------------------------
*/

setFlash(
    'Permintaan tidak valid.'
);

header('Location: index.php');
exit;