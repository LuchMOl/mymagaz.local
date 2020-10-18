<?php

namespace app\controllers;

use app\services\CurrencyService;
use app\services\UserService;

define("CURRENCY_VIEW_FOLDER", "../views/currency/");

class CurrencyController
{

    private $currencyService;
    private $userService;

    public function currencyService()
    {
        if ($this->currencyService === NULL) {
            $this->currencyService = new CurrencyService();
        }
        return $this->currencyService;
    }

    public function userService()
    {
        if ($this->userService === NULL) {
            $this->userService = new UserService();
        }
        return $this->userService;
    }

    public function actionIndex()
    {
        $allCurrency = $this->currencyService()->getAllCurrency();

        require_once CURRENCY_VIEW_FOLDER . 'showAll.php';
    }

    public function actionUpdateExchangeRates($param)
    {
        $response = file_get_contents("https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5");
        $response = json_decode($response, true);
        $this->currencyService()->updateExchangeRates($response);
        header('Location: /currency/');
    }

    public function actionActive()
    {
        if (!$_GET['default']) {
            if ($_POST['active']) {
                $this->currencyService()->disableActive($_GET['currencyId']);
            } else {
                $this->currencyService()->enableActive($_GET['currencyId']);
            }
        }
        header('Location: /currency/');
    }

    public function actionByDefault()
    {
        if (!$_POST['byDefault']) {
            $this->currencyService()->madeByDefault($_GET['currencyId']);
        }
        header("Location: /currency/");
    }

    public function actionByDefaultCurrencyForUser()
    {
        $this->userService()->byDefaultCurrencyForUser($_GET['currencyId']);
        header("Location:" . $_GET['uri']);
    }

    public function actionCreateNew()
    {
        $mode = 'create';

        if (isset($_POST['submitCurrencyForm'])) {
            $_POST['id'] = '';
            $_POST['active'] = isset($_POST['active']) ? '1' : '0';
            $_POST['byDefault'] = isset($_POST['byDefault']) ? '1' : '0';
            $newCurrency = $this->currencyService()->currencyMapper()->map($_POST);
            $this->currencyService()->createCurrency($newCurrency);
            header("Location: /currency/");
        }
        require_once CURRENCY_VIEW_FOLDER . 'edit-create.php';
    }

    public function actionEdit()
    {
        $mode = 'edit';
        $currency = $this->currencyService()->getCurrencyById($_GET['currencyId']);

        if (isset($_POST['submitCurrencyForm'])) {
            $_POST['id'] = $_GET['currencyId'];
            $_POST['active'] = isset($_POST['active']) ? '1' : '0';
            $_POST['byDefault'] = isset($_POST['byDefault']) ? '1' : $currency->getByDefault();
            $editedCurrency = $this->currencyService()->currencyMapper()->map($_POST);
            $this->currencyService()->editCurrency($editedCurrency);
            header("Location: /currency/");
        }
        require_once CURRENCY_VIEW_FOLDER . 'edit-create.php';
    }

}
