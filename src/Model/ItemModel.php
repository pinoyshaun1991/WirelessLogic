<?php
namespace WL\Model;

use Exception;
use WL\Service\ContentService;

/**
 * Class TransactionTable
 * @package Model
 */
class ItemModel
{
    /**
     * @var int
     */
    private $merchant;

    /**
     * @var string
     */
    private $date;

    /**
     * @var int
     */
    private $value;

    /**
     * @var string
     */
    private $fileSource;

    /**
     * @var array
     */
    private $rows;

    /**
     * @var CurrencyWebservice
     */
    private $currencyService;

    /**
     * TransactionTable constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->merchant         = 0;
        $this->date             = '';
        $this->value            = 0;
        $this->fileSource       = __DIR__.'/../../data/data.csv';
        $this->rows             = array();
        $this->currencyService  = new CurrencyWebserviceService();
    }

    /**
     * Set the merchant variable type
     *
     * @param $merchant
     * @return int
     * @throws Exception
     */
    private function setMerchant($merchant): int
    {
        if (is_null($merchant) || !is_numeric($merchant) || $merchant <= 0) {
            throw new Exception('Merchant is required and needs to be a positive number');
        }

        return $this->merchant = addslashes($merchant);
    }

    /**
     * Retrieve merchant id
     *
     * @return int
     */
    public function getMerchant(): int
    {
        return stripslashes($this->merchant);
    }

    /**
     * Set the date variable type
     *
     * @param $date
     * @return mixed
     * @throws Exception
     */
    private function setDate($date): string
    {
        $dateSplit = explode('/', $date);

        if (empty($date) || is_int($date) || checkdate($dateSplit[1], $dateSplit[0], $dateSplit[2]) === false) {
            throw new Exception('Date has to be valid and can not be null');
        }

        return $this->date = $date;
    }

    /**
     * Retrieve date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set the value variable type
     *
     * @param $value
     * @return mixed
     * @throws Exception
     */
    private function setValue($value): string
    {
        if (is_null($value)) {
            throw new Exception('Value can not be null');
        }

        $rawCurrency = filter_var($value, FILTER_SANITIZE_NUMBER_INT);

        if ($this->isCurrency($rawCurrency) == false) {
            throw new Exception('Value needs to be a valid currency type');
        }

        return $this->value = $this->currencyService->getExchangeRate($rawCurrency);
    }

    /**
     * Retrieve value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Check a valid currency type
     *
     * @param $number
     * @return false|int
     */
    private function isCurrency($number): int
    {
        return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
    }

    /**
     * Fetch all transactions
     *
     * @return array
     * @throws Exception
     */
    public function fetchTransactions(): array
    {
        if (($handle = fopen($this->fileSource, "r")) !== false) {
            $row = 0;
            while (($data[] = fgetcsv($handle, 1000, ";")) !== false) {

                if ($row > 0) {
                    $this->setMerchant($data[$row][0]);
                    $this->setDate($data[$row][1]);
                    $this->setValue($data[$row][2]);

                    $this->rows[] = array(
                        'merchant' => $this->getMerchant(),
                        'date'     => $this->getDate(),
                        'value'    => $this->getValue()
                    );
                }

                $row++;
            }
        }

        return $this->rows;
    }

    /**
     * Fetch transaction row by merchant id
     *
     * @param $merchant
     * @return array
     * @throws Exception
     */
    public function fetchTransactionByMerchantId($merchant): array
    {
        $this->setMerchant($merchant);
        $found = false;

        if (($handle = fopen($this->fileSource, "r")) !== false) {
            $row = 0;
            while (($data[] = fgetcsv($handle, 1000, ";")) !== false) {

                if (($row > 0 && $found === false) || !empty($this->rows)) {
                    if ($data[$row][0] == $this->getMerchant()) {
                        $this->rows[] = array(
                            'merchant' => $data[$row][0],
                            'date'     => $data[$row][1],
                            'value'    => $this->setValue($data[$row][2])
                        );

                        $found = true;
                    }
                }

                $row++;
            }

            if ($found === false) {
                throw new Exception('Unable to find transaction');
            }
        }

        return $this->rows;
    }
}