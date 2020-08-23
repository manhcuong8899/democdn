<?php
namespace VNPCMS\Currency\Repository;
use VNPCMS\Currency\Currency;

interface CurrencyRepositoryInterface
{
    public function ById($id);
    public function GetAll();
    public function CurrencyNull($code);
    public function CurrencyNullupdate($code,$id);

    public function create($attributes);
    public function deleteById($id);
    public function update(Currency $article, array $attributes);
}
