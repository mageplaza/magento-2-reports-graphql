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

namespace Mageplaza\ReportsGraphQl\Model\Resolver\Get\Detail;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Mageplaza\ReportsGraphQl\Model\Resolver\Filter\SearchResult;

/**
 * Class AbstractResolver
 * @package Mageplaza\ReportsGraphQl\Model\Resolver
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
        $args['currentPage'] = isset($args['currentPage']) ? $args['currentPage'] : 1;
        $args['pageSize']    = isset($args['pageSize']) ? $args['pageSize'] : 1;
        if ($args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }

        if ($args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }

        $searchResult = $this->filter->getResult($args, $this->_name);

        return [
            'total_count' => $searchResult->getTotalCount(),
            'items'       => $searchResult->getItems(),
            'page_info'   => $this->getPageInfo($searchResult, $args)
        ];
    }

    /**
     * @param SearchResult $searchResult
     * @param array $args
     *
     * @return array
     * @throws GraphQlInputException
     */
    private function getPageInfo($searchResult, $args)
    {
        $totalPages  = ceil($searchResult->getTotalCount() / $args['pageSize']);
        $currentPage = $args['currentPage'];

        if ($currentPage > $totalPages && $searchResult->getTotalCount() > 0) {
            throw new GraphQlInputException(__(
                'currentPage value %1 specified is greater than the %2 page(s) available.',
                [$currentPage, $totalPages]
            ));
        }

        return [
            'pageSize'        => $args['pageSize'],
            'currentPage'     => $currentPage,
            'hasNextPage'     => $currentPage < $totalPages,
            'hasPreviousPage' => $currentPage > 1,
            'startPage'       => 1,
            'endPage'         => $totalPages,
        ];
    }
}
