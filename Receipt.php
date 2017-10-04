<?php

class Receipt
{
    private $rollNumber;

    private $products = [];

    private $total;

    private $dateTime;

    private function __construct(string $rollNumber, array $products, int $total, DateTimeImmutable $datTime)
    {
        $this->rollNumber = $rollNumber;
        $this->products = $products;
        $this->total = $total;
        $this->dateTime = $datTime;
    }

    /**
     * @param array $products
     * @return Receipt
     */
    public static function createFromProducts(array $products)
    {
        $rollNumber = uniqid();
        $total = 0;

        foreach ($products as $product) {
            $total += $product->getPrice();
        }

        $receipt = new self($rollNumber, $products, $total, new DateTimeImmutable("now"));

        return $receipt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateTime(): \DateTimeImmutable
    {
        return $this->dateTime;
    }

}