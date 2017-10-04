<?php
require_once "autoload.php";


$products = [];
for ($i = 0; $i < 5; $i++) {
    $products[] = Product::fromSku($i);
}

$receipt = Receipt::createFromProducts($products);

//var_dump($receipt);

$refund = Refund::createFromReceipt($receipt);

var_dump($refund->process());
var_dump($refund->process());
