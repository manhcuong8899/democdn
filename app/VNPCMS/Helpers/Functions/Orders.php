<?php
function GetStatusOrder()
{
    return \VNPCMS\Orders\StatusOrder::orderBy('id','asc')->get();
}
?>