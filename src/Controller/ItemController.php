<?php

namespace WL\Controller;

use WL\Common\Controller\ItemInterface;
use Exception;
use WL\Model\ItemModel;

/**
 * Implements the item interface
 *
 * Class ItemController
 * @package WL\Controller
 */
class ItemController implements ItemInterface
{
    private $itemModel;
    private $site;

    /**
     * ItemController constructor.
     * @param string $site
     */
    public function __construct($site = '')
    {
        $this->itemModel = new ItemModel();
        $this->site      = $site;
    }

    /**
     * Fetch all items
     *
     * @return array|mixed
     * @throws \Exception
     */
    public function getItems()
    {
        $items = array();

        try {

            if ($this->site === '') {
                throw new Exception('Site is required');
            }

            $items = $this->itemModel->fetchItems($this->site);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $items;
    }
}