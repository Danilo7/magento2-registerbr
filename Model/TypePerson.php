<?php
/**
 * Created by PhpStorm.
 * @author Danilo Cavalcanti de Moura
 * Email: danilo-cm@hotmail.com
 */

namespace Fcamara\RegisterBrazil\Model;

use \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class TypePerson extends AbstractSource
{
    protected $_options;

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '1', 'label' => __('Physical')],
                ['value' => '0', 'label' => __('Legal')]
            ];
        }
        return $this->_options;
    }

    /**
     * @return array
     */
    final public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label' => __('Physical')),
            array('value' => '0', 'label' => __('Legal'))
        );
    }
}