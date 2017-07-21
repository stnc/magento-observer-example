<?php

class Stnc_Observerexample_Model_Observer
{

    public function send_email(Varien_Event_Observer $observer)
    {


        $orderIds = $observer->getData('order_ids');
        foreach ($orderIds as $_orderId) {
            $order = Mage::getModel('sales/order')->load($_orderId);
            $customer = Mage::getModel('customer/customer')->load($order->getData('customer_id'));
            $customer->getDefaultBillingAddress()->getLastname();
            $billingaddress = $order->getBillingAddress();
            try {
              //  var_dump($order);
                /* parameters can be change according to requirment */
                $params = array('customerName' => $order->getData('customer_firstname'),
                    'companyName' => $billingaddress->getData('company'),
                    'telephone' => $billingaddress->getData('telephone'),
                    'email' => $billingaddress->getData('email'),
                    'street' => $billingaddress->getData('street'),
                    'city' => $billingaddress->getData('city'),
                    'region' => $billingaddress->getData('region'),
                    'postcode' => $billingaddress->getData('postcode'),
                    'total' => $order->getGrandTotal());
                Mage::log('Order has been sent to exmaple.com 3534 '.var_export($params));

            } catch (Exception $e) {
                Mage::logException($e);
            }

        }

    }
}