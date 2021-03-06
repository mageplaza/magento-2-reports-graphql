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

namespace Mageplaza\ReportsGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\Reports\Helper\Data;
use Mageplaza\ReportsGraphQl\Helper\Auth;
use Mageplaza\ReportsGraphQl\Model\Resolver\Filter\Query\Filter;

/**
 * Class AbstractResolver
 * @package Mageplaza\ReportsGraphQl\Model\Resolver
 */
abstract class AbstractResolver implements ResolverInterface
{
    /**
     * @var string
     */
    protected $_aclResource = '';

    /**
     * @var string
     */
    protected $_name = '';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var Data
     */
    private $helper;

    /**
     * @var Auth
     */
    private $auth;

    /**
     * AbstractResolver constructor.
     *
     * @param Filter $filter
     * @param Data $helper
     * @param Auth $auth
     * @param string $name
     * @param string $aclResource
     */
    public function __construct(
        Filter $filter,
        Data $helper,
        Auth $auth,
        string $name = '',
        string $aclResource = ''
    ) {
        $this->filter = $filter;
        $this->helper = $helper;
        $this->auth   = $auth;
        if (!$this->_aclResource) {
            $this->_aclResource = $aclResource;
        }
        if (!$this->_name) {
            $this->_name = $name;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helper->isEnabled()) {
            throw new GraphQlInputException(__('The module is disabled'));
        }

        $filters = $args['filters'];

        if (!$this->auth->isAllowed($filters['accessToken'], $this->_aclResource)) {
            throw new GraphQlInputException(__("The consumer isn't authorized to access %1", $this->_aclResource));
        }

        return $this->handleArgs($filters);
    }

    /**
     * @param array $args
     *
     * @return mixed
     */
    abstract protected function handleArgs(array $args);
}
