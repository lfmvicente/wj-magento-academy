<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 05/10/20
 * Time: 10:06
 */

declare(strict_types=1);

namespace Webjump\PetGraphQl\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\BatchRequestItemInterface;
use Magento\Framework\GraphQl\Query\Resolver\BatchResolverInterface;
use Magento\Framework\GraphQl\Query\Resolver\BatchResponse;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\BatchResponseFactory;
use Webjump\Pet\Api\PetRepositoryInterface;

class Pet implements BatchResolverInterface
{
    private $batchResponseFactory;
    private $petRepository;

    public function __construct(BatchResponseFactory $batchResponseFactory, PetRepositoryInterface $petRepository)
    {
        $this->batchResponseFactory = $batchResponseFactory;
        $this->petRepository = $petRepository;
    }
    /**
     * Resolve multiple requests.
     *
     * @param ContextInterface $context GraphQL context.
     * @param Field $field FIeld metadata.
     * @param BatchRequestItemInterface[] $requests Requests to the field.
     * @return BatchResponse Aggregated response.
     * @throws \Throwable
     */
    public function resolve(ContextInterface $context, Field $field, array $requests): BatchResponse
    {
        $response = $this->batchResponseFactory->create();

        foreach ($requests as $item) {
            $arguments = $item->getArgs();
            $pet = $this->petRepository->getById($arguments['entity_id']);


            $response->addResponse($item, $pet->getData());
        }

        return $response;
    }
}
