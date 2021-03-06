<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\VersionsCms\Test\Block\Adminhtml\Widget\Instance\Edit\Tab\ParametersType;

use Magento\VersionsCms\Test\Block\Adminhtml\Widget\Instance\Edit\Tab\ParametersType\HierarchyNodeLinkForm\Form;
use Magento\Widget\Test\Block\Adminhtml\Widget\Instance\Edit\Tab\ParametersType\ParametersForm;
use Magento\Mtf\Client\Locator;

/**
 * Filling Widget Options that have hierarchy node link type.
 */
class CmsHierarchyNodeLink extends ParametersForm
{
    /**
     * Hierarchy Node Link block.
     *
     * @var string
     */
    protected $hierarchyNodeLinkForm = './ancestor::body//*[contains(@id, "responseCntoptions_fieldset")]';

    /**
     * Select node on widget options tab.
     *
     * @param array $entities
     * @return void
     */
    protected function selectEntity(array $entities)
    {
        foreach ($entities['value'] as $entity) {
            $this->_rootElement->find($this->selectEntity)->click();
            $this->getTemplateBlock()->waitLoader();
            $elementNew = $this->_rootElement->find($this->hierarchyNodeLinkForm, Locator::SELECTOR_XPATH);
            $entities['value'] = $entity->getIdentifier();
            $hierarchyFields['entities'] = $entities;
            $this->getHierarchyNodeLinkForm()->_fill($hierarchyFields, $elementNew);
            $this->getTemplateBlock()->waitLoader();
        }
    }

    /**
     * Get hierarchy node link form.
     *
     * @return Form
     */
    protected function getHierarchyNodeLinkForm()
    {
        $namespaceHierarchyNodeLinkForm = 'Magento\VersionsCms\Test\Block\Adminhtml\\' .
            'Widget\Instance\Edit\Tab\ParametersType\HierarchyNodeLinkForm\Form';
        return $this->blockFactory->create(
            $namespaceHierarchyNodeLinkForm,
            ['element' => $this->_rootElement->find($this->hierarchyNodeLinkForm, Locator::SELECTOR_XPATH)]
        );
    }
}
