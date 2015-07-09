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
    'enabled',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'length'   => 1,
        'comment'  => 'Design status',
    )
);

$installer->endSetup();