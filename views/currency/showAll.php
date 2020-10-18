<?php

namespace app\views\currency;

require_once '../views/layouts/admin/header.php';
?>

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
            <?php foreach ($allCurrency as $currency) : ?>

                <tr>
                    <td><?= $currency->getId(); ?></td>
                    <td>
                        <form method = 'post' action = '/currency/edit/?currencyId=<?= $currency->getId(); ?>'>
                            <input name = 'ccy' type="submit" value="<?= $currency->getCcy(); ?>" />
                        </form>
                    </td>
                    <td><?= $currency->getTitle(); ?></td>
                    <td><?= $currency->getBuyRates(); ?></td>
                    <td><?= $currency->getSellRates(); ?></td>
                    <td>
                        <form method = 'post' action = '/currency/byDefault/?currencyId=<?= $currency->getId(); ?>'>
                            <input name = 'byDefault' type="submit" value="<?= $currency->getByDefault(); ?>" />
                        </form>
                    </td>
                    <td>
                        <form method = 'post' action = '/currency/active/?currencyId=<?= $currency->getId(); ?>&default=<?= $currency->getByDefault(); ?>'>
                            <input name = 'active' type="submit" value="<?= $currency->getActive(); ?>" />
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
    <br>
    <form method = 'post' action = '/currency/updateExchangeRates/'>
        <input name = 'updateExchangeRates' type="submit" value="UpdateExchangeRates" />
    </form>
</div>

<?php
require_once '../views/layouts/admin/footer.php';
