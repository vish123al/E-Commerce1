<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\CoreBundle\Form\Elements;

/**
 * Class PriceModifier
 *
 * @package WellCommerce\Bundle\CoreBundle\Form\Elements
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PriceModifier extends Price implements ElementInterface
{

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        if (!isset($this->attributes['base_price_field']) || !($this->attributes['base_price_field'] instanceof Field)) {
            throw new Exception("Base price source field (attribute: base_price_field) not set for field '{$this->attributes['name']}'.");
        }
        $this->attributes['base_price_field_name'] = $this->attributes['base_price_field']->getName();
        $this->attributes['suffixes']              = App::getModel('suffix/suffix')->getSuffixTypesForSelect();
    }

    public function prepareAttributesJs()
    {
        return [
            $this->formatAttributeJs('name', 'sName'),
            $this->formatAttributeJs('label', 'sLabel'),
            $this->formatAttributeJs('comment', 'sComment'),
            $this->formatAttributeJs('suffix', 'sSuffix'),
            $this->formatAttributeJs('prefixes', 'asPrefixes'),
            $this->formatAttributeJs('error', 'sError'),
            $this->formatAttributeJs('vat_field_name', 'sVatField'),
            $this->formatAttributeJs('base_price_field_name', 'sBasePriceField'),
            $this->formatAttributeJs('vat_values', 'aoVatValues', ElementInterface::TYPE_OBJECT),
            $this->formatAttributeJs('suffixes', 'oSuffixes', ElementInterface::TYPE_OBJECT),
            $this->formatRulesJs(),
            $this->formatDependencyJs(),
        ];
    }
}
