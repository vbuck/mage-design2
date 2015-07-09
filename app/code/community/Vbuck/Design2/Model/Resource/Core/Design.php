<?php

/**
 * Core design resource model extensions.
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

class Vbuck_Design2_Model_Resource_Core_Design
    extends Mage_Core_Model_Resource_Design
{

    /**
     * Check intersections
     *
     * @param int  $storeId   The current store ID.
     * @param date $dateFrom  The from date.
     * @param date $dateTo    The to date.
     * @param int  $currentId The current design ID.
     * 
     * @return boolean
     */
    protected function _checkIntersection($storeId, $dateFrom, $dateTo, $currentId)
    {
        // Now that we support multiple design changes, collisions allowed
        if (parent::_checkIntersection($storeId, $dateFrom, $dateTo, $currentId)) {
            Mage::getSingleton('adminhtml/session')->addNotice(
                Mage::helper('design2')->__('Notice: You may have multiple intersecting design changes.')
            );
        }

        return false;
    }

}