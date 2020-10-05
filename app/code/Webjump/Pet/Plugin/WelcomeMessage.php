<?php
/**
 * Created by PhpStorm.
 * User: webjump-nb138
 * Date: 02/10/20
 * Time: 17:29
 */

declare(strict_types=1);

namespace Webjump\Pet\Plugin;

use Magento\Theme\Block\Html\Header;
use Webjump\Pet\Model\GetPetNameForOnlineCustomer;


class WelcomeMessage
{
    private $getPetNameForOnlineCustomer;

    public function __construct(GetPetNameForOnlineCustomer $getPetNameForOnlineCustomer)
    {
        $this->getPetNameForOnlineCustomer = $getPetNameForOnlineCustomer;
    }

    public function afterGetWelcome(Header $subject, $result)
    {
        return $result . $this->getPetNameForOnlineCustomer->execute();
    }
}
