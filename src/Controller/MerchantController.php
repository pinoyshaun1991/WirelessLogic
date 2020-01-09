<?php

namespace Awin\Controller;

use Awin\Common\Controller\TransactionInterface;
use Exception;
use Awin\Model\TransactionTableModel;

/**
 * Implements the transaction interface
 *
 * Class Merchant
 * @package Controller
 */
class MerchantController implements TransactionInterface
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionTableModel();
    }

    /**
     * Fetch all transactions
     *
     * @return array|mixed
     * @throws \Exception
     */
    public function getTransactions()
    {
        $transactions = array();

        try {
            $transactions = $this->transactionModel->fetchTransactions();
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $transactions;
    }

    /**
     * Fetch merchant transactions
     *
     * @param $id
     * @return array|mixed
     */
    public function getTransactionsByMerchant($id)
    {
        $merchantTransactions = array();

        try {
            $merchantTransactions = $this->transactionModel->fetchTransactionByMerchantId($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $merchantTransactions;
    }
}