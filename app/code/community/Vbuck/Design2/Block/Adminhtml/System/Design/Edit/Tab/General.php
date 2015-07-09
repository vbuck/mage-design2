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

class Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tab_General
    extends Mage_Adminhtml_Block_System_Design_Edit_Tab_General
{

    /**
     * Prepare the form.
     * 
     * @return Vbuck_Design2_Block_Adminhtml_System_Design_Edit_Tab_Layout
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();

        $form       = $this->getForm();
        $fieldset   = $form->getElement('general');

        $form->getElement('design')->setRequired(false);

        $fieldset->addField(
            'enabled', 
            'select', 
            array(
                'name'      => 'enabled',
                'label'     => Mage::helper('design2')->__('Enabled'),
                'options'   => Mage::getSingleton('design2/system_config_source_status')->getAllOptions(),
            ),
            'store_id'
        );

        $fieldset->addField(
            'name', 
            'text', 
            array(
                'name'      => 'name',
                'label'     => Mage::helper('design2')->__('Name'),
            ),
            'enabled'
        );

        $fieldset->addField(
            'target_path', 
            'text', 
            array(
                'name'      => 'target_path',
                'label'     => Mage::helper('design2')->__('Target Path'),
                'after_element_html'
                            => '<p class="note">' . Mage::helper('design2')->__('Separate multiples with commas.') . '</p>',
            ),
            'name'
        );

        Mage::dispatchEvent('design2_edit_tab_general_prepare_form', array('form' => $form));

        $formData = Mage::getSingleton('adminhtml/session')->getDesignData(true);

        if (!$formData) {
            $formData = Mage::registry('design')->getData();
        } else {
            $formData = $formData['design'];
        }

        $form->addValues($formData);

        return $this;
    }

}