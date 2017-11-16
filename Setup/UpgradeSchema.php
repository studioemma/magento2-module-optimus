<?php

namespace StudioEmma\Optimus\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Add og_image column
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.1.2') < 0) {

            $setup->getConnection()->addColumn(
                $setup->getTable('cms_page'),
                'og_image',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '2M',
                    'nullable' => true,
                    'comment' => 'OG Image'
                ]
            );

        }

        $setup->endSetup();
    }
}
