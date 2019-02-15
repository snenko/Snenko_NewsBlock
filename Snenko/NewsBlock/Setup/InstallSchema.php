<?php


namespace Snenko\NewsBlock\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        //Your install script

        $table_snenko_newsblock_posts = $setup->getConnection()->newTable($setup->getTable('snenko_newsblock_posts'));

        $table_snenko_newsblock_posts->addColumn(
            'posts_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_snenko_newsblock_posts->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Name'
        );

        $table_snenko_newsblock_posts->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'description'
        );

        $table_snenko_newsblock_posts->addColumn(
            'label',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'label'
        );

        $table_snenko_newsblock_posts->addColumn(
            'location',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'location'
        );

        $table_snenko_newsblock_posts->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'is_active'
        );

        $table_snenko_newsblock_posts->addColumn(
            'active_from',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            null,
            [],
            'active_from'
        );

        $table_snenko_newsblock_posts->addColumn(
            'active_to',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            null,
            [],
            'active_to'
        );

        $table_snenko_newsblock_posts->addColumn(
            'image',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            500,
            [],
            'image'
        );

        $table_snenko_newsblock_posts->addColumn(
            'link_url',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            2000,
            [],
            'Link Url'
        );

        $table_snenko_newsblock_labels = $setup->getConnection()->newTable($setup->getTable('snenko_newsblock_labels'));

        $table_snenko_newsblock_labels->addColumn(
            'labels_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_snenko_newsblock_labels->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            [],
            'background_color'
        );

        $table_snenko_newsblock_labels->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            ['unsigned' => true, 'nullable' => true],
            'Store ID'
        );

        $table_snenko_newsblock_labels->addColumn(
            'content',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            2000,
            ['nullable' => False],
            'content'
        );

        $table_snenko_newsblock_labels->addColumn(
            'background_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [],
            'background_color'
        );

        $table_snenko_newsblock_labels->addColumn(
            'text_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            [],
            'text_color'
        );

        $setup->getConnection()->createTable($table_snenko_newsblock_labels);
        $setup->getConnection()->createTable($table_snenko_newsblock_posts);
    }
}