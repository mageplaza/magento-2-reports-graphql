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

/**
 * Class MostViewedProducts
 * @package Mageplaza\ReportsGraphQl\Model\Resolver\Get\Card
 */
class MostViewedProducts extends AbstractResolver
{
    /**
     * @var string
     */
    protected $_aclResource = 'Mageplaza_Reports::dashboard';

    /**
     * @var string
     */
    protected $_name = 'mostViewedProducts';
}
