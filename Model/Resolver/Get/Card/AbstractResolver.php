<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_ReportsGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\ReportsGraphQl\Model\Resolver\Get\Card;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Mageplaza\Reports\Api\Data\CardInterface;

/**
 * Class AbstractResolver
 * @package Mageplaza\ReportsGraphQl\Model\Resolver\Get\Card
 */
class AbstractResolver extends \Mageplaza\ReportsGraphQl\Model\Resolver\AbstractResolver
{
    /**
     * @param array $args
     *
     * @return array
     * @throws GraphQlInputException
     */
    protected function handleArgs(array $args)
    {
        try {
            return $this->filter->getResultCardByName($this->_name, $args);
        } catch (NoSuchEntityException $e) {
            throw new GraphQlInputException(__($e->getMessage()));
        }
    }
}
