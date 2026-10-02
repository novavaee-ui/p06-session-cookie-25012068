<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

/*
|--------------------------------------------------------------------------
| Cookie Tema
|--------------------------------------------------------------------------
*/

$allowedThemes = ['light', 'dark'];

$theme = isset($_COOKIE['theme'])
    ? $_COOKIE['theme']
    : 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

/*
|--------------------------------------------------------------------------
| Mengubah Tema
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {

    $candidate = $_POST['theme'];

    if (in_array($candidate, $allowedThemes, true)) {

        setcookie(
            'theme',
            $candidate,
            [
                'expires' => time() + (60 * 60 * 24 * 30),
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );

        header('Location: index.php');
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| Data Produk
|--------------------------------------------------------------------------
*/

$products = require __DIR__ . '/data/products.php';

$title = 'Katalog Produk';

$flash = pullFlash();

require_once __DIR__ . '/components/header.php';

?>

<?php if ($flash !== null): ?>

    <div class="flash">
        <?= e($flash) ?>
    </div>

<?php endif; ?>


<h2>Daftar Produk</h2>

<p>
    Silakan pilih produk yang ingin dimasukkan ke keranjang.
</p>


<div class="produk-grid">

    <?php foreach ($products as $id => $product): ?>

        <div class="produk-card">

            <div class="produk-icon">
                🛍️
            </div>

            <h2>
                <?= e($product['nama']) ?>
            </h2>

            <div class="harga">

                Rp
                <?= number_format(
                    $product['harga'],
                    0,
                    ',',
                    '.'
                ) ?>

            </div>

            <form
                action="actions.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="action"
                    value="add"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= (int) $id ?>"
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    + Tambah ke Keranjang
                </button>

            </form>

        </div>

    <?php endforeach; ?>

</div>


<!-- Pilihan Tema -->

<div style="margin-top: 30px;">

    <h3>
        Tema Tampilan
    </h3>

    <form method="POST">

        <?php if ($theme === 'light'): ?>

            <input
                type="hidden"
                name="theme"
                value="dark"
            >

            <button
                type="submit"
                class="btn btn-secondary"
            >
                🌙 Gunakan Tema Gelap
            </button>

        <?php else: ?>

            <input
                type="hidden"
                name="theme"
                value="light"
            >

            <button
                type="submit"
                class="btn btn-secondary"
            >
                ☀️ Gunakan Tema Terang
            </button>

        <?php endif; ?>

    </form>

</div>


<?php

require_once __DIR__ . '/components/footer.php';

?>