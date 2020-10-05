<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 05/10/20
 * Time: 15:46
 */

declare(strict_types=1);

namespace Webjump\PetGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\Pet\Api\PetRepositoryInterface;

class DeletePet implements ResolverInterface
{
    private $petRepository;

    public function __construct(PetRepositoryInterface $petRepository)
    {
        $this->petRepository = $petRepository;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param \Magento\Framework\GraphQl\Config\Element\Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @throws \Exception
     * @return mixed|Value
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        try {
            $this->petRepository->deleteById($args['entity_id']);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
