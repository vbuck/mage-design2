<?php

/**
 * Design status source model.
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

class Vbuck_Design2_Model_System_Config_Source_Status
{

    /**
     * Get all status options.
     * 
     * @return array
     */
    public function getAllOptions()
    {
        $options = array();

        foreach ($this->toOptionArray() as $option) {
            $options[$option['value']] = $option['label'];
        }

        return $options;
    }

    /**
     * Get all statuses as an option array.
     * 
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '0',
                'label' => Mage::helper('design2')->__('Disabled'),
            ),
            array(
                'value' => '1',
                'label' => Mage::helper('design2')->__('Enabled'),
            ),
        );
    }

}