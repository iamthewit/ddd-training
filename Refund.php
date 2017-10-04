<?php

class Refund
{
    const REFUND_CASH = 'cash';

    const REFUND_CREDIT = 'credit';

    private $receipt;

    private $refundDate;

    private $refundType;

    private function __construct(Receipt $receipt)
    {
        $this->receipt = $receipt;
    }

    /**
     * @param Receipt $receipt
     * @return Refund
     */
    public static function createFromReceipt(Receipt $receipt)
    {
        return new self($receipt);
    }

    /**
     * @return bool
     */
    public function process()
    {
        // receipt already refunded
        if ($this->alreadyProcessed()) {
            return false;
        }

        $dateTimeNow = new DateTime();
        $dateDiff = $dateTimeNow->diff($this->receipt->getDateTime());
        $daysSinceReceipt = $dateDiff->format("days");

        // receipt date < 30 days
        if ($daysSinceReceipt < 30) {
            // full refund
            $this->refundDate = new DateTimeImmutable();
            $this->refundType = static::REFUND_CASH;

            return true;
        }

        // receipt date < 365 days
        if ($daysSinceReceipt < 365) {
            // store credit refund
            $this->refundDate = new DateTimeImmutable();
            $this->refundType = static::REFUND_CREDIT;

            return true;
        }

        return false;

    }

    private function alreadyProcessed()
    {
        if (isset($this->refundDate)) {
            return true;
        }

        return false;
    }

}