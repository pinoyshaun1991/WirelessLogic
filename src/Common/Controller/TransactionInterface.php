<?php
namespace Awin\Common\Controller;

/**
 * Declaring the methods needed to display transactions
 *
 * Interface TransactionInterface
 * @package Common\Controller
 */
interface TransactionInterface
{
    /**
     * Get all transactions
     *
     * @return mixed
     */
    public function getTransactions();

    /**
     * Get transaction row by id
     *
     * @param $id
     * @return mixed
     */
    public function getTransactionsByMerchant($id);
}