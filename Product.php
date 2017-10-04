<?php

class Product
{

    private $sku;

    private $name;

    private $description;

    private $price;

    /**
     * Product constructor.
     * @param string $sku
     * @param string $name
     * @param string $description
     * @param int    $price
     */
    public function __construct(string $sku, string $name, string $description, int $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @param string $sku
     * @return Product
     */
    public static function fromSku(string $sku)
    {
        return new self($sku, 'Product '.rand(1, 100), 'Lorem Ipsum', rand(1, 100));
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

}