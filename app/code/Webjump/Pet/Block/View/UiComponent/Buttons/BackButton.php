<?php

declare(strict_types=1);

namespace Webjump\Pet\Block\View\UiComponent\Buttons;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton implements ButtonProviderInterface
{
    /** @var UrlInterface $url */
    private $url;
    /**
     * BackButton constructor.
     *
     * @param UrlInterface $url
     */
    public function __construct(UrlInterface $url)
    {
        $this->url = $url;
    }
    /**
     * Get button data.
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->url->getUrl('*/*/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
