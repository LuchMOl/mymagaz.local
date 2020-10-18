<?php

namespace app\services;

use app\dao\CurrencyDao;
use app\dao\mapper\CurrencyMapper;
use app\services\UserService;

class CurrencyService
{

    private $currencyDao;
    private $currencyMapper;

    public function currencyDao()
    {
        if ($this->currencyDao === NULL) {
            $this->currencyDao = new CurrencyDao();
        }
        return $this->currencyDao;
    }

    public function currencyMapper()
    {
        if ($this->currencyMapper === NULL) {
            $this->currencyMapper = new CurrencyMapper();
        }
        return $this->currencyMapper;
    }

    public function getAllCurrency()
    {
        $allRow = $this->currencyDao()->selectAll();
        foreach ($allRow as $row) {
            $currency = $this->currencyMapper()->map($row);
            $allCurrency [] = $currency;
        }
        return $allCurrency;
    }

    public function getCurrencyByDefault()
    {
        $row = $this->currencyDao()->getCurrencyByDefault();
        return $this->currencyMapper()->map($row);
    }

    public function getCurrencyById($id)
    {
        $row = $this->currencyDao()->getCurrencyById($id);
        return $this->currencyMapper()->map($row);
    }

    public function updateExchangeRates($rates)
    {
        $this->currencyDao()->updateExchangeRates($rates);
    }

    public function convertPrice($products)
    {
        $userService = new UserService();

        $user = $userService->getCurrentUser();
        $allCurrency = $this->getAllCurrency();


        foreach ($products as $product) {
            foreach ($allCurrency as $currency) {
                if ($product->getCurrencyId() == $currency->getId()) {
                    $productCurrency = $currency;
                }
                if ($user->getCurrencyId() == $currency->getId()) {
                    $userCurrency = $currency;
                }
            }
            if ($product->getCurrency() !== $userCurrency->getId()) {
                $price = $product->getPrice();
                $convertPrice = $price * $productCurrency->getSellRates() / $userCurrency->getSellRates();
                $product->setPrice(round($convertPrice, 2));
            }
            $product->setCurrency($userCurrency);
        }
    }

    public function madeByDefault($currencyId)
    {
        $this->currencyDao()->enableActive($currencyId);
        $this->currencyDao()->madeByDefault($currencyId);
    }

    public function disableActive($currencyId)
    {
        $this->currencyDao()->disableActive($currencyId);
    }

    public function enableActive($currencyId)
    {
        $this->currencyDao()->enableActive($currencyId);
    }

    public function createCurrency($currency)
    {
        $this->currencyDao()->insertCurrency($currency);
    }

    public function editCurrency($currency)
    {
        $this->currencyDao()->editCurrency($currency);
    }

}
