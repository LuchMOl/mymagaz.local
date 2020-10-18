<?php

namespace app\dao;

class CurrencyDao extends BaseDao
{

    public function selectAll()
    {
        $sql = "SELECT id, ccy, title, buy_rates as buyRates, sell_rates as sellRates , by_default as byDefault, active"
                . " FROM currency";
        $result = $this->getAll($sql);
        return $result;
    }

    public function updateExchangeRates($rates)
    {
        $sql = "UPDATE currency "
                . "SET buy_rates = :buy_rates, "
                . "sell_rates = :sell_rates "
                . "WHERE ccy = :ccy";
        foreach ($rates as $rate) {
            $params = ['buy_rates' => $rate['buy'], 'sell_rates' => $rate['sale'], 'ccy' => $rate['ccy']];
            $this->execute($sql, $params);
        }
    }

    public function getCurrencyByDefault()
    {
        $sql = "SELECT id, ccy, title, buy_rates as buyRates, sell_rates as sellRates , by_default as byDefault, active "
                . "FROM currency WHERE by_default = 1";
        return $this->getRow($sql);
    }

    public function getCurrencyById($id)
    {
        $sql = "SELECT id, ccy, title, buy_rates as buyRates, sell_rates as sellRates , by_default as byDefault, active "
                . "FROM currency WHERE id = :id";
        $params = ['id' => $id];
        return $this->getRow($sql, $params);
    }

    public function madeByDefault($currencyId)
    {
        $this->unsetByDefault();
        $sql = "UPDATE currency SET by_default = :by_default WHERE id = :id";
        $params = ['by_default' => '1', 'id' => $currencyId];
        $this->execute($sql, $params);
    }

    public function unsetByDefault()
    {
        $sql = "UPDATE currency SET by_default = :by_default WHERE by_default = :default";
        $params = ['by_default' => '0', 'default' => '1'];
        $this->execute($sql, $params);
    }

    public function disableActive($currencyId)
    {
        $sql = "UPDATE currency SET active = :disable WHERE id = :id";
        $params = ['disable' => '0', 'id' => $currencyId];
        $this->execute($sql, $params);
    }

    public function enableActive($currencyId)
    {
        $sql = "UPDATE currency SET active = :enable WHERE id = :id";
        $params = ['enable' => '1', 'id' => $currencyId];
        $this->execute($sql, $params);
    }

    public function insertCurrency($currency)
    {
        $sql = "INSERT INTO currency (ccy, title, buy_rates, sell_rates, by_default, active) "
                . "VALUES (:ccy, :title, :buy_rates, :sell_rates, :by_default, :active)";
        $params = ['ccy' => $currency->getCcy(),
            'title' => $currency->getTitle(),
            'buy_rates' => $currency->getBuyRates(),
            'sell_rates' => $currency->getSellRates(),
            'by_default' => '0',
            'active' => $currency->getActive()];
        $res = $this->execute($sql, $params);

        $id = $this->insert_ID();
        if ($currency->getByDefault()) {
            $this->enableActive($id);
            $this->madeByDefault($id);
        }
    }

    public function editCurrency($currency)
    {
        $sql = "UPDATE currency "
                . "SET ccy = :ccy, "
                . "title = :title, "
                . "buy_rates = :buy_rates, "
                . "sell_rates = :sell_rates, "
                . "by_default = :by_default, "
                . "active = :active "
                . "WHERE id = :id";
        $params = ['id' => $currency->getId(),
            'ccy' => $currency->getCcy(),
            'title' => $currency->getTitle(),
            'buy_rates' => $currency->getBuyRates(),
            'sell_rates' => $currency->getSellRates(),
            'by_default' => '0',
            'active' => $currency->getActive()];
        $this->execute($sql, $params);

        if ($currency->getByDefault()) {
            $this->enableActive($currency->getId());
            $this->madeByDefault($currency->getId());
        }
    }

}
