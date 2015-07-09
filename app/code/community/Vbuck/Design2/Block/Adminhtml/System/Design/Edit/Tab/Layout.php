<?php

/**
 * Layout tab form block.
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

class Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tab_Layout
    extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare the form.
     * 
     * @return Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tab_Layout
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset(
            'general', 
            array(
                'legend'    => Mage::helper('design2')->__('General Settings'),
                'class'     => 'fieldset-wide',
            )
        );

        $fieldset->addField(
            'custom_layout_update_xml', 
            'textarea', 
            array(
                'name'      => 'custom_layout_update_xml',
                'label'     => Mage::helper('cms')->__('Custom Layout Update XML'),
                'style'     => 'height:24em;',
            )
        );

        Mage::dispatchEvent('design2_edit_tab_layout_prepare_form', array('form' => $form));

        $formData = Mage::getSingleton('adminhtml/session')->getDesignData(true);

        if (!$formData) {
            $formData = Mage::registry('design')->getData();
        } else {
            $formData = $formData['design'];
        }

        $form->addValues($formData);
        $form->setFieldNameSuffix('design');
        $this->setForm($form);

        return $this;
    }

}