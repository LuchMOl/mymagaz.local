<?php

namespace app\views\currency;

use app\models\Currency;

require_once '../views/layouts/admin/header.php';

$modeEdit = $mode == 'edit';
$modeCreate = $mode == 'create';
$title = $modeCreate ? 'Добавить валюту' : 'Редактировать валюту';

$currency = isset($currency) ? $currency : new Currency();
?>

<div class='container'>
    <br>
    <hr>

    <h2><?= $title; ?></h2><br>

    <div class="currency">
        <table class="currency_table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ssy</th>
                    <th>title</th>
                    <th>buy_rates</th>
                    <th>sell_rates</th>
                    <th>by_default</th>
                    <th>active</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $currency->getId(); ?></td>
                    <td><?= $currency->getCcy(); ?></td>
                    <td><?= $currency->getTitle(); ?></td>
                    <td><?= $currency->getBuyRates(); ?></td>
                    <td><?= $currency->getSellRates(); ?></td>
                    <td><?= $currency->getByDefault(); ?></td>
                    <td><?= $currency->getActive(); ?></td>
                </tr>
            </tbody>
        </table>
    </div><br>

    <form method = 'post' action = '' enctype="multipart/form-data">

        <h4>ccy</h4>
        <input name = 'ccy' type = 'text' value = "<?= $currency->getCcy(); ?>">
        <hr>

        <h4>title</h4>
        <input name = 'title' type = 'text' value = "<?= $currency->getTitle(); ?>">
        <hr>

        <h4>buy rates</h4>
        <input name = 'buyRates' type = 'number' value = "<?= $currency->getBuyRates(); ?>">
        <hr>

        <h4>sell rates</h4>
        <input name = 'sellRates' type = 'number' value = "<?= $currency->getSellRates(); ?>">
        <hr>

        <h4>by default</h4>
        <input name = 'byDefault' type="checkbox" value="<?= $currency->getByDefault(); ?>" <?= $currency->getByDefault() ? 'checked' : ''; ?>>
        <hr>

        <h4>active</h4>
        <input name = 'active' type="checkbox" value="<?= $currency->getActive(); ?>" <?= $currency->getActive() ? 'checked' : ''; ?>>
        <hr>

        <input name = 'submitCurrencyForm' type = submit value = 'Подтвердить'>

    </form><br>

    <hr>
</div>

<?php
require_once '../views/layouts/admin/footer.php';
