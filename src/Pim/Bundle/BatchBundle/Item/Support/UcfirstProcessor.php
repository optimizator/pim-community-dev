<?php

namespace Pim\Bundle\BatchBundle\Item\Support;

use Pim\Bundle\BatchBundle\Item\ItemProcessorInterface;

/**
 * Very basic sample transformer that will put the first letter of each item in uppercase
 *
 * @author    Benoit Jacquemont <benoit@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
class UcfirstProcessor implements ItemProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($item)
    {
        return ucfirst($item);
    }
}