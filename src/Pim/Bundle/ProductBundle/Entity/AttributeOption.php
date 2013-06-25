<?php
namespace Pim\Bundle\ProductBundle\Entity;

use Oro\Bundle\FlexibleEntityBundle\Entity\Mapping\AbstractEntityAttributeOption;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Attribute options
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *
 * @ORM\Table(name="pim_product_attribute_option")
 * @ORM\Entity(repositoryClass="Pim\Bundle\ProductBundle\Entity\Repository\AttributeOptionRepository")
 */
class AttributeOption extends AbstractEntityAttributeOption
{

    /**
     * Overrided to change target entity name
     *
     * @var Attribute $attribute
     *
     * @ORM\ManyToOne(targetEntity="ProductAttribute", inversedBy="options")
     */
    protected $attribute;

    /**
     * @var ArrayCollection $values
     *
     * @ORM\OneToMany(
     *     targetEntity="AttributeOptionValue", mappedBy="option", cascade={"persist", "remove"}, orphanRemoval=true
     * )
     */
    protected $optionValues;

    /**
     * Default value is mandatory
     *
     * @var string $defaultValue
     *
     * @ORM\Column(name="default_value", type="string", length=255, nullable=false)
     */
    protected $defaultValue;

    /**
     * Specifies whether this AttributeOption is the default option for the attribute
     *
     * @var boolean $default
     *
     * @ORM\Column(name="is_default", type="boolean")
     */
    protected $default = false;

    /**
     * Override to use default value
     *
     * @return string
     */
    public function __toString()
    {
        $value = $this->getOptionValue();

        return ($value and $value->getValue()) ? $value->getValue() : (string) $this->getDefaultValue();
    }

    /**
     * Set default
     * @param boolen $default
     *
     * @return AttributeOption
     */
    public function setDefault($default)
    {
        $this->default = (bool) $default;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function isDefault()
    {
        return $this->default;
    }
}