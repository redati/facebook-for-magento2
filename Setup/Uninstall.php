<?php
/**
 * Copyright (c) Meta Platforms, Inc. and affiliates. All Rights Reserved
 */
namespace Facebook\BusinessExtension\Setup;

use Facebook\BusinessExtension\Model\Config\ProductAttributes;
use Facebook\BusinessExtension\Model\Config\Source\Product\GoogleProductCategory;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Attribute;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

class Uninstall implements UninstallInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var ProductAttributes
     */
    private $productAttributes;

    /**
     * Uninstall constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param ProductAttributes $productAttributes
     */
    public function __construct(EavSetupFactory $eavSetupFactory, ProductAttributes $productAttributes)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->productAttributes = $productAttributes;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     * @throws LocalizedException
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->dropTable('facebook_business_extension_config');
        $setup->getConnection()->delete('core_config_data', "path LIKE 'facebook/%'");
    }
}
