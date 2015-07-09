<?php

/**
 * Design grid block.
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
 * @category Class_Type_Block
 * @package  Vbuck_Design2
 * @author   Rick Buczynski <me@rickbuczynski.com>
 */

class Vbuck_Design2_Block_Adminhtml_System_Design_Grid
    extends Mage_Adminhtml_Block_System_Design_Grid
{

    /**
     * Declare grid columns.
     *
     * @return Vbuck_Design2_Block_Adminhtml_System_Design_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumnAfter(
            'name', 
            array(
                'header'    => Mage::helper('design2')->__('Name'),
                'align'     => 'left',
                'width'     => '220px',
                'type'      => 'text',
                'index'     => 'name',
            ),
            Mage::app()->isSingleStoreMode() ? 'package' : 'store_id'
        );

        $this->addColumnAfter(
            'target_path', 
            array(
                'header'    => Mage::helper('design2')->__('Target Path'),
                'align'     => 'left',
                'width'     => '100px',
                'type'      => 'text',
                'index'     => 'target_path',
            ),
            'name'
        );

        $this->addColumnAfter(
            'enabled', 
            array(
                'header'    => $this->__('Status'),
                'width'     => '80px',
                'align'     => 'left',
                'index'     => 'enabled',
                'type'      => 'options',
                'options'   => Mage::getSingleton('design2/system_config_source_status')->getAllOptions(),
                'frame_callback' 
                            => array($this, 'decorateStatus'),
            ),
            'date_to'
        );

        parent::_prepareColumns();

        return $this;
    }

    /**
     * Decorate status column values
     *
     * @return string
     */
    public function decorateStatus($value, Varien_Object $row)
    {
        $class      = $row->getEnabled() ? 'grid-severity-notice' : 'grid-severity-critical';
        $options    = Mage::getSingleton('design2/system_config_source_status')->getAllOptions();

        return '
            <span class="' . $class . '">
                <span>' . $options[intval($row->getEnabled())] . '</span>
            </span>
        ';
    }

}