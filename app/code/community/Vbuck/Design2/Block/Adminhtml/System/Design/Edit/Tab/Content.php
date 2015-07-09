<?php

/**
 * Content tab form block.
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
class Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tab_Content
    extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare the form.
     * 
     * @return Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tab_Content
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
            'custom_content_before', 
            'textarea', 
            array(
                'name'      => 'custom_content_before',
                'label'     => Mage::helper('design2')->__('Before Content'),
                'style'     => 'height:12em;',
                'after_element_html'
                            => '<p class="note">' . Mage::helper('design2')->__('Accepts any HTML to appear before any page content.') . '</p>',
            )
        );

        $fieldset->addField(
            'custom_content_after', 
            'textarea', 
            array(
                'name'      => 'custom_content_after',
                'label'     => Mage::helper('design2')->__('After Content'),
                'style'     => 'height:12em;',
                'after_element_html'
                            => '<p class="note">' . Mage::helper('design2')->__('Accepts any HTML to appear after any page content.') . '</p>',
            )
        );

        Mage::dispatchEvent('design2_edit_tab_content_prepare_form', array('form' => $form));

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