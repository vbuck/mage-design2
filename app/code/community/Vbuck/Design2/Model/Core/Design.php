<?php

/**
 * Core design model extensions.
 * 
 * PHP Version 5
 * 
 * @category  Class
 * @package   Vbuck_Design2
 * @author    Rick Buczynski <me@rickbuczynski.com>
 * @copyright 2015 Rick Buczynski
 */

/**
 * Class declaration
 *
 * @category Class_Type_Model
 * @package  Vbuck_Design2
 * @author   Rick Buczynski <me@rickbuczynski.com>
 */

class Vbuck_Design2_Model_Core_Design
    extends Mage_Core_Model_Design
{

    /* @var $_preparedCollection Mage_Core_Model_Resource_Design_Collection */
    protected $_preparedCollection;

    /**
     * Setup the prepared design change collection.
     * 
     * @param int    $storeId The current store ID.
     * @param string $date    The current date.
     * 
     * @return Mage_Core_Model_Resource_Design_Collection
     */
    protected function _initCollection($storeId, $date = null)
    {
        if (!$this->_preparedCollection) {
            if (is_null($date)) {
                $date = Varien_Date::now();
            }

            $collection = $this->getCollection()
                ->addStoreFilter($storeId);

            $collection->getSelect()
                ->where('enabled = 1')
                ->where('date_from <= ? or date_from IS NULL', $date)
                ->where('date_to >= ? or date_to IS NULL', $date);

            $this->_preparedCollection = $collection;
        }

        return $this->_preparedCollection;
    }

    /**
     * Get the prepared collection.
     * 
     * @return Mage_Core_Model_Resource_Design_Collection
     */
    public function getPreparedCollection()
    {
        return $this->_preparedCollection;
    }

    /**
     * Load a design change.
     * 
     * @param int    $storeId The current store ID.
     * @param string $date    The current date.
     * 
     * @return Vbuck_Design2_Model_Core_Design
     */
    public function loadChange($storeId, $date = null)
    {
        $collection = $this->_initCollection($storeId, $date);

        // Compatibility with core functionality
        // Uses the last loaded design change to assign the package
        $lastChange = $collection->getLastItem();

        if ($lastChange->getDesign()) {
            $tmp = explode('/', $lastChange->getDesign());
            $lastChange->setPackage($tmp[0])
                ->setTheme($tmp[1]);
        }

        $this->setData($lastChange->getData());

        return $this;
    }

}