<?php

namespace Omnipay\WechatPay;

use Omnipay\WechatPay\Message\UnifiedOrderResponse;

/**
 * Class JsapiGateway
 *
 * @package Omnipay\WechatPay
 */
class JsapiGateway extends BaseAbstractGateway {

    protected $trade_type = 'JSAPI';
}
