<?php

namespace WL\Controller;

use WL\Common\Controller\ItemInterface;
use Exception;
use Awin\Model\TransactionTableModel;

/**
 * Implements the item interface
 *
 * Class Merchant
 * @package Controller
 */
class ItemController implements ItemInterface
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