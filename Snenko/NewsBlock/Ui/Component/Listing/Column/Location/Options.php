<?php

namespace Snenko\NewsBlock\Ui\Component\Listing\Column\Location;


use Magento\Framework\Data\OptionSourceInterface;

/**
 * @api
 * @since 100.1.0
 */
class Options implements OptionSourceInterface
{

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     * @since 100.1.0
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 1,
                'label' => __('Location - 1')
            ],
            [
                'value' => 2,
                'label' => __('Location - 2')
            ],
            [
                'value' => 3,
                'label' => __('Location - 3')
            ],
            [
                'value' => 4,
                'label' => __('Location - 4')
            ],
            [
                'value' => 5,
                'label' => __('Location - 5')
            ]
        ];
    }
}

