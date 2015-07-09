<?php

/**
 * Base observer model.
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

class Vbuck_Design2_Model_Observer
{

    /**
     * Add custom HTML content to the layout.
     * 
     * @param Mage_Core_Model_Layout $layout   The current layout instance.
     * @param string                 $content  The HTML content.
     * @param string                 $position An optional positioning value.
     *
     * @return void
     */
    protected function _addContentUpdate(Mage_Core_Model_Layout $layout, $content = null, $position = null)
    {
        if (!$content) {
            return;
        }

        $blockId    = 'CUSTOM_' . microtime(true);
        $before     = $position ? (' before="' . $position . '"') : '';
        $xml        = '
            <reference name="content">
                <block type="core/text" name="' . $blockId . '"' . $before . '>
                    <action method="setText">
                        <text><![CDATA[' . $content . ']]></text>
                    </action>
                </block>
            </reference>
        ';

        $this->_addUpdate($layout, $xml);
    }

    /**
     * Add a custom layout update.
     * 
     * @param Mage_Core_Model_Layout $layout The current layout instance.
     * @param string                 $xml    The layout update XML.
     *
     * @return void
     */
    protected function _addUpdate(Mage_Core_Model_Layout $layout, $xml)
    {
        $update = simplexml_load_string(
            '<update_xml>' . $xml . '</update_xml>', 
            $layout->getUpdate()->getElementClass()
        );

        $layout->getUpdate()
            ->addUpdate($xml);
    }

    /**
     * Validate the target against the loaded designs.
     * 
     * @param string                 $targetPath The target path.
     * @param Mage_Core_Model_Design $design     The current design change.
     * 
     * @return boolean
     */
    protected function _validatePath($targetPath, Mage_Core_Model_Design $design)
    {
        $availablePaths = array_filter( ( explode(',', $design->getTargetPath()) ) );

        return ( empty($availablePaths) ) || in_array($targetPath, $availablePaths);
    }

    /**
     * Add layout updates from the design data.
     * 
     * @param Varien_Event_Observer $observer The event observer object.
     *
     * @return void
     * 
     * @event controller_action_layout_generate_xml_before
     */
    public function addLayoutUpdates(Varien_Event_Observer $observer)
    {
        try {
            $event      = $observer->getEvent();
            $layout     = $event->getLayout();
            $targetPath = $event->getAction()->getFullActionName();
            $collection = Mage::getSingleton('core/design')->getPreparedCollection();

            foreach ($collection as $change) {
                if ($this->_validatePath($targetPath, $change)) {
                    if ($change->getCustomLayoutUpdateXml()) {
                        $layout->getUpdate()
                            ->addUpdate($change->getCustomLayoutUpdateXml());
                    }

                    if ($change->getCustomContentBefore()) {
                        $this->_addContentUpdate($layout, $change->getCustomContentBefore(), '-');
                    }

                    if ($change->getCustomContentAfter()) {
                        $this->_addContentUpdate($layout, $change->getCustomContentAfter());
                    }
                }
            }
        } catch (Exception $error) {
            Mage::logException($error);
        }
    }

}