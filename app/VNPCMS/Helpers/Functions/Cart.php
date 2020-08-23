<?php

function getTotal($cart)
{
    $total=0;
    foreach ($cart as $index=>$value)
    {
        $total = $total + $value->qty*$value->price;
    }
    return $total;
}

function getDownprice($cart)
{
    $fee=0;
    foreach ($cart as $index=>$value)
    {
        $fee = $fee + $value->options->coupons;
    }
    return $fee;
}


function getTransportFee($cart,$transportfee)
{
    $feeship=0;
    foreach ($cart as $index=>$value)
    {
        $feeship = $feeship + ($value->qty*$value->options->weight*$transportfee)/1000;
    }
    return $feeship;
}
