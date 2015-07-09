<?php

/**
 * Extend design table.
 * 
 * PHP Version 5
 * 
 * @category  Setup
 * @package   Vbuck_Design2
 * @author    Rick Buczynski <me@rickbuczynski.com>
 * @copyright 2015 Rick Buczynski
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer  = $this;
$connection = $installer->getConnection();
$table      = $installer->getTable('core/design_change');

$installer->startSetup();

$connection->addColumn(
    $table,
    'name',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'   => 255,
        'comment'  => 'Design internal label',
    )
);

$connection->addColumn(
    $table,
    'target_path',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'   => 255,
        'comment'  => 'Design change request path',
    )
);

$connection->addColumn(
    $table,
    'custom_layout_update_xml',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment'  => 'Custom layout XML',
    )
);

$connection->addColumn(
    $table,
    'custom_content_before',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment'  => 'Custom content (pre)',
    )
);

$connection->addColumn(
    $table,
    'custom_content_after',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment'  => 'Custom content (post)',
    )
);

$installer->endSetup();