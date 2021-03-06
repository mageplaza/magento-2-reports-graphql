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

namespace Mageplaza\ReportsGraphQl\Model\Resolver\Filter\Query;

use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;
use Mageplaza\Reports\Api\CardManagementInterface;
use Mageplaza\Reports\Helper\Data;
use Mageplaza\ReportsGraphQl\Model\Resolver\Filter\SearchResult;
use Mageplaza\ReportsGraphQl\Model\Resolver\Filter\SearchResultFactory;

/**
 * Retrieve filtered data based off given search criteria in a format that GraphQL can interpret.
 */
class Filter
{
    /**
     * @var Builder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var CardManagementInterface
     */
    private $cardManagement;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Data
     */
    private $helperData;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * Filter constructor.
     *
     * @param Builder $searchCriteriaBuilder
     * @param SearchResultFactory $searchResultFactory
     * @param RequestInterface $request
     * @param ProductFactory $productFactory
     * @param CardManagementInterface $cardManagement
     * @param Data $helperData
     */
    public function __construct(
        Builder $searchCriteriaBuilder,
        SearchResultFactory $searchResultFactory,
        RequestInterface $request,
        ProductFactory $productFactory,
        CardManagementInterface $cardManagement,
        Data $helperData
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultFactory   = $searchResultFactory;
        $this->cardManagement        = $cardManagement;
        $this->request               = $request;
        $this->helperData            = $helperData;
        $this->productFactory        = $productFactory;
    }

    /**
     * @param $args
     * @param $name
     *
     * @return SearchResult
     * @throws GraphQlInputException
     */
    public function getResult($args, $name): SearchResult
    {
        $this->addFilterParams($args);
        $searchCriteria = $this->searchCriteriaBuilder->build($name, $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);

        if (!class_exists('\Mageplaza\ReportsPro\Model\Api\DetailManagement')) {
            throw new GraphQlInputException(__('Module Mageplaza_ReportsPro does not exits'));
        }

        $detailManagement = $this->helperData->createObject('\Mageplaza\ReportsPro\Model\Api\DetailManagement');
        $list             = $detailManagement->get($name, $searchCriteria);
        $listArray        = [];

        $count = 0;
        foreach ($list->getItems() as $item) {
            $listArray[$count] = $item->getData();

            if ($item->getProductId()) {
                $product                               = $this->productFactory->create()->load($item->getProductId());
                $listArray[$count]['product']          = $product->getData();
                $listArray[$count]['product']['model'] = $product;
            }

            $listArray[$count]['model'] = $item;
            $count++;
        }

        return $this->searchResultFactory->create($list->getTotalCount(), $listArray);
    }

    /**
     * @param $name
     * @param $args
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getResultCardByName($name, $args)
    {
        $this->addFilterParams($args);
        switch ($name) {
            case 'averageOrder':
            case 'averageOrderValue':
            case 'conversionFunnel':
            case 'lifetimeSales':
            case 'orders':
            case 'repeatCustomerRate':
            case 'salesByLocation':
            case 'shipping':
            case 'tax':
            case 'totalSales':
            case 'salesByCustomerGroup':
            case 'salesByHoursChart':
            case 'salesByWeekdayChart':
                $card = $this->cardManagement->get($name);

                return $card->getData();
            case 'bestsellers':
            case 'customers':
            case 'lastOrders':
            case 'lastSearches':
            case 'mostViewedProducts':
            case 'newCustomers':
            case 'topSearches':
            case 'abandonedCart':
            case 'stockvsSold':
            case 'customerByLocation':
            case 'salesByAttributeSet':
            case 'salesByCategory':
            case 'salesByCoupon':
            case 'salesByHours':
            case 'salesByPayment':
            case 'salesByPostcode':
            case 'salesByTaxRate':
            case 'salesByWeekday':
            case 'userWishList':
                $card = $this->cardManagement->get($name);

                return ['items' => $card->getData()];
            default:
                return [];
        }
    }

    /**
     * @param $args
     */
    protected function addFilterParams($args)
    {
        $params = $this->request->getParams();
        $params = array_merge($params, $args);
        $this->request->setParams($params);
    }
}
