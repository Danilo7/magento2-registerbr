<?php
/**
 * Created by PhpStorm.
 * @author Danilo Cavalcanti de Moura
 * Email: danilo-cm@hotmail.com
 */

namespace Fcamara\RegisterBrazil\Model\Customer\Metadata;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Model\Metadata\ElementFactory;
use Magento\Customer\Model\Metadata\Form;
use Fcamara\RegisterBrazil\Helper\Data;

class ExtendForm extends Form
{
    const ATTRIBUTE_CODE_CPF = 'cpf';

    const ATTRIBUTE_CODE_CNPJ = 'cnpj';

    const ATTRIBUTE_CODE_TAXVAT = 'taxvat';

    const ATTRIBUTE_TYPE_PERSON = 'type_person';

    /**
     * @var
     */
    protected $_helper;

    /**
     * @var
     */
    private $messageManager;

    public function __construct(
        CustomerMetadataInterface $customerMetadataService,
        AddressMetadataInterface $addressMetadataService,
        ElementFactory $elementFactory,
        \Magento\Framework\App\RequestInterface $httpRequest,
        \Magento\Framework\Module\Dir\Reader $modulesReader,
        \Magento\Framework\Validator\ConfigFactory $validatorConfigFactory,
        string $entityType,
        string $formCode,
        array $attributeValues = [],
        bool $ignoreInvisible = self::IGNORE_INVISIBLE,
        array $filterAttributes = [],
        bool $isAjax = false,
        Data $helper,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->_helper = $helper;
        $this->messageManager = $messageManager;
        parent::__construct(
            $customerMetadataService,
            $addressMetadataService,
            $elementFactory,
            $httpRequest,
            $modulesReader,
            $validatorConfigFactory,
            $entityType,
            $formCode,
            $attributeValues,
            $ignoreInvisible,
            $filterAttributes,
            $isAjax
        );
    }

    /**
     * @todo Extract data from request and return associative data array
     * @param \Magento\Framework\App\RequestInterface $request
     * @param null $scope
     * @param bool $scopeOnly
     * @return array
     * @throws InputException
     * @throws \Exception
     * @throws \Exception
     */
    public function extractData(\Magento\Framework\App\RequestInterface $request, $scope = null, $scopeOnly = true)
    {
        $data = [];
        foreach ($this->getAllowedAttributes() as $attribute) {
            $dataModel = $this->_getAttributeDataModel($attribute);
            $dataModel->setRequestScope($scope);
            $dataModel->setRequestScopeOnly($scopeOnly);
            $data[$attribute->getAttributeCode()] = $dataModel->extractValue($request);
        }

        if (!array_key_exists(self::ATTRIBUTE_CODE_TAXVAT, $data)) {
            return $data;
        }

        $data[self::ATTRIBUTE_CODE_TAXVAT] = $this->removeSpecialChars($data[self::ATTRIBUTE_CODE_TAXVAT]);

        //Validate CPF/CNPJ
        if (
            $data[self::ATTRIBUTE_TYPE_PERSON] == '1'
            && !$this->_helper->validateCPF($data[self::ATTRIBUTE_CODE_TAXVAT])
        ) {
            $this->messageManager->addErrorMessage('CPF not valid!');
            throw new \Exception('CPF not valid!');
        }

        if (
            $data[self::ATTRIBUTE_TYPE_PERSON] == '0'
            && !$this->_helper->validateCNPJ($data[self::ATTRIBUTE_CODE_TAXVAT])
        ) {
            $this->messageManager->addErrorMessage('CNPJ not valid!');
            throw new \Exception('CNPJ not valid!');
        }

        return $data;
    }

    /**
     * @todo remove all special characters
     * @param $string
     * @return null|string|string[]
     */
    public function removeSpecialChars($string)
    {
        $string = str_replace('-', '', $string);
        $string = str_replace('/', '', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}