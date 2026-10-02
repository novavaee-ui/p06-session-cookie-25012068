<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

$title = 'Keranjang Belanja';

$flash = pullFlash();

require_once __DIR__ . '/components/header.php';
?>

<?php if ($flash !== null): ?>

    <div class="flash">
        <?= e($flash) ?>
    </div>

<?php endif; ?>


<h2>Keranjang Belanja</h2>


<?php if (empty($_SESSION['cart'])): ?>

    <div class="empty">

        <h3>Keranjang masih kosong 🛒</h3>

        <p>
            Silakan pilih produk terlebih dahulu.
        </p>

        <a
            href="index.php"
            class="btn btn-primary"
        >
            Kembali ke Produk
        </a>

    </div>

<?php else: ?>

    <?php

    $total = 0;

    ?>

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>Produk</th>

                    <th>Harga</th>

                    <th>Jumlah</th>

                    <th>Subtotal</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>

                    <?php

                    if (!isset($products[$id])) {
                        continue;
                    }

                    $product = $products[$id];

                    $quantity = (int) $quantity;

                    $subtotal = $product['harga'] * $quantity;

                    $total += $subtotal;

                    ?>

                    <tr>

                        <td>
                            <?= e($product['nama']) ?>
                        </td>

                        <td>
                            Rp
                            <?= number_format(
                                $product['harga'],
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>

                        <td>
                            <?= $quantity ?>
                        </td>

                        <td>
                            Rp
                            <?= number_format(
                                $subtotal,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>

                        <td>

                            <form
                                action="actions.php"
                                method="POST"
                                style="display:inline;"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="remove"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $id ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>


        <div class="total">

            Total:
            Rp
            <?= number_format(
                $total,
                0,
                ',',
                '.'
            ) ?>

        </div>


        <div style="margin-top:20px;">

            <a
                href="index.php"
                class="btn btn-primary"
            >
                ← Belanja Lagi
            </a>


            <form
                action="actions.php"
                method="POST"
                style="display:inline;"
            >

                <input
                    type="hidden"
                    name="action"
                    value="clear"
                >

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    Kosongkan Keranjang
                </button>

            </form>

        </div>

    </div>

<?php endif; ?>


<?php
require_once __DIR__ . '/components/footer.php';
?>