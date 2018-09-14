<?php
/**
 * Created by PhpStorm.
 * @author Danilo Cavalcanti de Moura
 * Email: danilo-cm@hotmail.com
 */

namespace Fcamara\RegisterBrazil\Block\Widget;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Block\Widget\AbstractWidget;


class TypePerson extends AbstractWidget
{
    /**
     * @var
     */
    protected $_type_person;

    /**
     * TypePerson constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Helper\Address $addressHelper
     * @param CustomerMetadataInterface $customerMetadata
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Address $addressHelper,
        CustomerMetadataInterface $customerMetadata,
        array $data = []
    ) {
        parent::__construct($context, $addressHelper, $customerMetadata, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Sets the template
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/type_person.phtml');
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('Fcamara\RegisterBrazil\Model\TypePerson');

        return $model->toOptionArray();
    }
}