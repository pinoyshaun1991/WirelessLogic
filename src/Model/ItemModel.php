<?php
namespace WL\Model;

use Exception;
use WL\Service\ContentService;

/**
 * Class ItemModel
 * @package WL\Model
 */
class ItemModel
{
    /**
     * @var string
     */
    private $optionTitle;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $price;

    /**
     * @var string
     */
    private $discount;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ItemModel constructor.
     */
    public function __construct()
    {
        $this->optionTitle    = '';
        $this->description    = '';
        $this->price          = 0;
        $this->discount       = '';
        $this->contentService = new ContentService();
    }

    /**
     * Set the option title variable type
     *
     * @param $optionTitle
     * @return string
     * @throws Exception
     */
    private function setOptionTitle($optionTitle): string
    {
        if (is_null($optionTitle)) {
            throw new Exception('Option title is required');
        }

        return $this->optionTitle = $optionTitle;
    }

    /**
     * Retrieve option title
     *
     * @return string
     */
    public function getOptionTitle(): string
    {
        return $this->optionTitle;
    }

    /**
     * Set the description variable type
     *
     * @param $description
     * @return string
     * @throws Exception
     */
    private function setDescription($description): string
    {
        if (is_null($description)) {
            throw new Exception('Description is required');
        }

        return $this->description = $description;
    }

    /**
     * Retrieve description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the price variable type
     *
     * @param $price
     * @return int
     * @throws Exception
     */
    private function setPrice($price): int
    {
        if (is_null($price) || !is_numeric($price) || $price <= 0) {
            throw new Exception('Price is required and needs to be a positive number');
        }

        return $this->price = $price;
    }

    /**
     * Retrieve price
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * Set the discount variable type
     *
     * @param $discount
     * @return string
     * @throws Exception
     */
    private function setDiscount($discount): string
    {
        if (is_null($discount)) {
            throw new Exception('Discount is required');
        }

        return $this->discount = $discount;
    }

    /**
     * Retrieve discount
     *
     * @return string
     */
    public function getDiscount(): string
    {
        return $this->discount;
    }

    /**
     * Fetch all items
     *
     * @param $site
     * @return string
     * @throws Exception
     */
    public function fetchItems($site): string
    {
        $dataArray = $this->contentService->getContent($site);
        $result = array();

        foreach ($dataArray as $data) {
            $this->setOptionTitle($data['optionTitle']);
            $this->setDescription($data['description']);
            $this->setPrice(str_replace('£', '', $data['price']));
            $this->setDiscount(isset($data['discount']) ? $data['discount'] : '');

            $result[$this->getPrice()]['optionTitle'] = $this->getOptionTitle();
            $result[$this->getPrice()]['description'] = $this->getDescription();
            $result[$this->getPrice()]['price']       = $this->getPrice();
            $result[$this->getPrice()]['discount']    = $this->getDiscount();
        }

        $data = json_encode(array_reverse($result));
        echo $data;

        return $data;
    }
}