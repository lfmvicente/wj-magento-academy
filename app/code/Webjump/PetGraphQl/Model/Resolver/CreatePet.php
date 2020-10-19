<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 05/10/20
 * Time: 14:55
 */

declare(strict_types=1);

namespace Webjump\PetGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\Pet\Model\PetFactory;
use Webjump\Pet\Api\PetRepositoryInterface;

class CreatePet implements ResolverInterface
{
    private $petFactory;
    private $petRepository;

    public function __construct(PetFactory $petFactory, PetRepositoryInterface $petRepository)
    {
        $this->petFactory = $petFactory;
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
    )
    {
        if (empty($args['input']) || !is_array($args['input'])) {
            throw new GraphQlInputException(__('Missing input values'));
        }

        if (empty($args['input']['name'])) {
            throw new GraphQlInputException(__('Missing name value'));
        }

        $pet = $this->petFactory->create();
        $pet->setName($args['input']['name']);
        $pet->setDescription($args['input']['description']);
        $this->petRepository->save($pet);

        return ['pet' => $pet->getData()];
    }
}
