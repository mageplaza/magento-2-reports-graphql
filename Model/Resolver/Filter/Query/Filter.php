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
 * @package     Mageplaza_GiftCardGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\ReportsGraphQl\Model\Resolver\Filter\Query;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder;
use Mageplaza\Reports\Api\CardManagementInterface;
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
     * Filter constructor.
     *
     * @param Builder $searchCriteriaBuilder
     * @param SearchResultFactory $searchResultFactory
     * @param CardManagementInterface $cardManagement
     */
    public function __construct(
        Builder $searchCriteriaBuilder,
        SearchResultFactory $searchResultFactory,
        RequestInterface $request,
        CardManagementInterface $cardManagement
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultFactory = $searchResultFactory;
        $this->cardManagement = $cardManagement;
        $this->request = $request;
    }

    /**
     * @param array $args
     * @param string $type
     *
     * @return SearchResult
     */
//    public function getResult($args, $type): SearchResult
//    {
//        $searchCriteria = $this->searchCriteriaBuilder->build($type, $args);
//        $searchCriteria->setCurrentPage($args['currentPage']);
//        $searchCriteria->setPageSize($args['pageSize']);
//
//        switch ($type) {
//            case 'mpGiftCode':
//                $list = $this->giftCodeManagement->getList($searchCriteria);
//                break;
//            case 'mpGiftPool':
//                $list = $this->giftPoolManagement->getList($searchCriteria);
//                break;
//            case 'mpGiftTemplate':
//            default:
//                $list = $this->giftTemplateManagement->getList($searchCriteria);
//                break;
//        }
//
//        $listArray = [];
//        /** @var GiftCardModel|PoolModel|TemplateModel $item */
//        foreach ($list->getItems() as $item) {
//            $listArray[$item->getId()]          = $item->getData();
//            $listArray[$item->getId()]['model'] = $item;
//        }
//
//        return $this->searchResultFactory->create($list->getTotalCount(), $listArray);
//    }

    /**
     * @param $name
     * @return array
     * @throws NoSuchEntityException
     */
    public function getResultCardByName($name, $arg)
    {
        $params = $this->request->getParams();
        $params = array_merge($params, $arg);
        $this->request->setParams($params);
        switch ($name) {
            case 'averageOrder':
            case 'averageOrderValue':
            case 'conversionFunnel':
                $card = $this->cardManagement->get($name);
                return $card->getData();
            case 'bestsellers':
            case 'customers':
                $card = $this->cardManagement->get($name);
                return ['items' => $card->getData()];
            default:
                return '$this->giftTemplateManagement->get($id)';
        }
    }
}
