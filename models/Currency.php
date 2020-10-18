<?php

namespace app\models;

class Currency
{

    private $id;
    private $ccy;
    private $title;
    private $buyRates;
    private $sellRates;
    private $byDefault;
    private $active;

    public function getId()
    {
        return $this->id;
    }

    public function getCcy()
    {
        return $this->ccy;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBuyRates()
    {
        return $this->buyRates;
    }

    public function getSellRates()
    {
        return $this->sellRates;
    }

    public function getByDefault()
    {
        return $this->byDefault;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCcy($ccy)
    {
        $this->ccy = $ccy;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setBuyRates($buyRates)
    {
        $this->buyRates = $buyRates;
    }

    public function setSellRates($sellRates)
    {
        $this->sellRates = $sellRates;
    }

    public function setByDefault($byDefault)
    {
        $this->byDefault = $byDefault;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function isDefault()
    {
        return $this->getByDefault() ? $this->getByDefault() : false;
    }

}
