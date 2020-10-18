<?php

namespace app\dao\mapper;

use app\models\Currency;

class CurrencyMapper
{

    public function map($data)
    {
        $currency = new Currency();

        $currency->setId($data['id']);
        $currency->setCcy($data['ccy']);
        $currency->setTitle($data['title']);
        $currency->setBuyRates($data['buyRates']);
        $currency->setSellRates($data['sellRates']);
        $currency->setByDefault($data['byDefault']);
        $currency->setActive($data['active']);

        return $currency;
    }

}
