<?php
/**
 * Created by PhpStorm.
 * @author Danilo Cavalcanti de Moura
 * Email: danilo-cm@hotmail.com
 */

namespace Fcamara\RegisterBrazil\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @var array
     */
    public $used_in_forms = [];

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->used_in_forms[] = 'adminhtml_customer';
        $this->used_in_forms[] = 'checkout_register';
        $this->used_in_forms[] = 'customer_account_create';
        $this->used_in_forms[] = 'customer_account_edit';
        $this->used_in_forms[] = 'adminhtml_checkout';
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        /** @var $attributeSet AttributeSet */
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        //CREATE ATTRIBUTES
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'type_person',
            [
                'type' => 'int',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'label' => 'Type Person',
                'input' => 'select',
                'source' => 'Fcamara\RegisterBrazil\Model\TypePerson',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' =>999,
                'system' => 0,
            ]
        );

        $attributeTypePerson = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'type_person')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $this->used_in_forms
            ]);

        $attributeTypePerson->save();

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'social_name',
            [
                'type' => 'varchar',
                'label' => 'Social Name',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' =>999,
                'system' => 0,
            ]
        );

        $attributeSocialName = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'social_name')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $this->used_in_forms
            ]);

        $attributeSocialName->save();

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'state_registration',
            [
                'type' => 'varchar',
                'label' => 'State Registration',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' =>999,
                'system' => 0,
            ]
        );

        $attributeStateRegistration = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'state_registration')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $this->used_in_forms
            ]);

        $attributeStateRegistration->save();

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'fantasy_name',
            [
                'type' => 'varchar',
                'label' => 'Fantasy Name',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' =>999,
                'system' => 0,
            ]
        );

        $attributeFantasyName = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'fantasy_name')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $this->used_in_forms
            ]);

        $attributeFantasyName->save();

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'cnpj',
            [
                'type' => 'varchar',
                'label' => 'CNPJ',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' =>999,
                'system' => 0,
            ]
        );

        $attributeCnpj = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'cnpj')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $this->used_in_forms
            ]);

        $attributeCnpj->save();

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'cpf',
            [
                'type' => 'varchar',
                'label' => 'CPF',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' =>999,
                'system' => 0,
            ]
        );

        $attributeCpf = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'cpf')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => $this->used_in_forms
            ]);

        $attributeCpf->save();
    }
}