<?php

/**
 * Design tabs configuration block.
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

class Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tabs
    extends Mage_Adminhtml_Block_System_Design_Edit_Tabs
{

    /**
     * Prepare the screen layout.
     * 
     * @return Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tabs
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->addTab(
            'layout', 
            array(
                'label'     => Mage::helper('design2')->__('Layout'),
                'content'   => $this->getLayout()->createBlock('design2/adminhtml_system_design_edit_tab_layout')->toHtml(),
            )
        );

        $this->addTab(
            'content', 
            array(
                'label'     => Mage::helper('design2')->__('Content'),
                'content'   => $this->getLayout()->createBlock('design2/adminhtml_system_design_edit_tab_content')->toHtml(),
            )
        );

        return $this;
    }

}