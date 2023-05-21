<?php declare(strict_types=1);

namespace Tsg\BlogExtra\Plugin;

use Magento\Framework\Event\Observer;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Tsg\Blog\Observer\LogPostDetailView;

class AddDataToPostDetailObserver
{
    private $timezone;

    public function __construct(
        TimezoneInterface $timezone,
    ){
        $this->timezone = $timezone;
    }

    public function  beforeExecute(
        LogPostDetailView $subject,
        Observer $observer,
    ){
        $request = $observer->getData('request');
        $request->setParam('datetime', $this->timezone->date());

        return [$observer];
    }
}
