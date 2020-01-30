<?php
namespace WL\Common\Controller;

/**
 * Declaring the methods needed to display items
 *
 * Interface ItemInterface
 * @package Common\Controller
 */
interface ItemInterface
{
    /**
     * Get all items
     *
     * @return mixed
     */
    public function getItems();
}