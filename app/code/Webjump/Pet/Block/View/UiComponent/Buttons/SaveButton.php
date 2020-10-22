<?php

declare(strict_types=1);

namespace Webjump\Pet\Block\View\UiComponent\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

class SaveButton implements ButtonProviderInterface
{
    /**
     * Get button data.
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save & Close'),
            'class' => 'save primary',
            'class_name' => Container::DEFAULT_CONTROL,
            'options' => [],
        ];
    }
}
