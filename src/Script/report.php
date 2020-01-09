<?php

use Awin\Controller\MerchantController;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/phplucidframe/console-table/src/LucidFrame/Console/ConsoleTable.php';

/**
 * Print transactions
 */

if (!function_exists('readline')) {
    function readline($question)
    {
        $fh = fopen('php://stdin', 'r');
        echo $question;
        $userInput = trim(fgets($fh));
        fclose($fh);

        return $userInput;
    }
}

displayTransactions();

function displayTransactions()
{
    $merchant = new MerchantController();
    $transactionAnswer = readline('Do you want to list all transactions? Answer Y/N: ');
    $table = new LucidFrame\Console\ConsoleTable();
    $table
        ->addHeader('Merchant')
        ->addHeader('Date')
        ->addHeader('Value');

    if ($transactionAnswer === 'Y' || $transactionAnswer === 'y') {
        foreach ($merchant->getTransactions() as $transaction) {
            $table
                ->addRow()
                ->addColumn($transaction['merchant'])
                ->addColumn($transaction['date'])
                ->addColumn($transaction['value']);
        }

        $table->display();
        echo <<<EOL

EOL;

        $exitAnswer = readline(' do you want to exit? Answer Y/N: ');

        if ($exitAnswer === 'Y' || $exitAnswer === 'y') {
            exit();
        } else {
            displayTransactions();
        }
    } else if ($transactionAnswer === 'N' || $transactionAnswer === 'n') {
        $merchantId      = readline('What is the merchant id you would like to view? ');
        $merchantResults = $merchant->getTransactionsByMerchant($merchantId);

        if (!empty($merchantResults)) {
            foreach ($merchantResults as $transaction) {
                $table
                    ->addRow()
                    ->addColumn($transaction['merchant'])
                    ->addColumn($transaction['date'])
                    ->addColumn($transaction['value']);
            }

            $table->display();
            echo <<<EOL

EOL;
        }

        $exitAnswer = readline(' do you want to exit? Answer Y/N: ');

        if ($exitAnswer === 'Y' || $exitAnswer === 'y') {
            exit();
        } else {
            displayTransactions();
        }
    } else {
        displayTransactions();
    }
}

