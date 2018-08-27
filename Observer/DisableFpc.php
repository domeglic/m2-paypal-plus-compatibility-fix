<?php

namespace C4B\PaypalPlusCompatibilityFix\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Explicitly FPC when creating paypal plus order. Request is mistakenly categorized as "cachable" which results in session
 * being closed before "order success" data is written to it.
 *
 * @see \Iways\PayPalPlus\Controller\Order\Create::execute
 * @see \Magento\Email\Model\Template\Filter::emulateAreaCallback - layout is created, but is still empty
 * @see \Magento\PageCache\Model\Layout\DepersonalizePlugin::afterGenerateXml - checks if layout is cacheable. But it is empty. Session is closed.
 * @see \Magento\Quote\Model\QuoteManagement::placeOrder - successfull order data is written to session, but it will not get persisted
 *
 * @package    C4B_PaypalPlusCompatibilityFix
 * @author     Dominik Meglič <meglic@code4business.de>
 */
class DisableFpc implements ObserverInterface
{
    /**
     * @var \Magento\Framework\App\Cache\StateInterface
     */
    private $cacheState;

    /**
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     */
    public function __construct(\Magento\Framework\App\Cache\StateInterface $cacheState)
    {
        $this->cacheState = $cacheState;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $this->cacheState->setEnabled(\Magento\PageCache\Model\Cache\Type::TYPE_IDENTIFIER, false);
    }
}