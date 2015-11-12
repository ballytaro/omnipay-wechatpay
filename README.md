# Omnipay-WechatPay

## Installation
To install, simply add it to your composer.json file:
```json
{
    "require": {
        "omnipay/omnipay": "dev-master"
    }
}
```

## Usage
### Create unified order
```php
use Omnipay\Omnipay;

$gateway = Omnipay::create( 'WechatPay' );
$gateway->setAppId( 'Your appid here.' );
$gateway->setMchId( 'Your mch_id here.' );
$gateway->setKey( 'Your key for WeChat payment here.' );
$gateway->setTradeType( 'JSAPI' );
$gateway->setAttach( 'test' );
$gateway->setBody( 'test' );
$gateway->setGoodsTag( 'test' );
$gateway->setOutTradeNo( $out_trade_no );
$gateway->setTotalFee( 1 );
$gateway->setSpbillCreateIP( Request::ip() );
$gateway->setNotifyUrl( 'http://test.com/pay/notify' );

$response = $gateway->createUnifiedOrder()->send(); // Get prepay_id, code_url etc.

$package = $response->createWebPaymentPackage(); // Get payment parameters for web
```

### Validate notification parameters
You can validate parameters as follow:
```php
use Omnipay\Omnipay;

$request_content = file_get_contents('php://input');
$gateway = Omnipay::create( 'WechatPay' );
$gateway->setKey( 'Your key for WeChat payment here.' );

$complete_request = $gateway->completeOrder( $$request_content );  // Auto convert xml string to array

$complete_response = $complete_request->send();
$complete_response->isResultSuccessful();
$complete_response->isResponseSuccessful();

/**
 * Would get xml string followed while function 'isResultSuccessful' return Boolean true:
 *    <xml><return_code><![CDATA[SUCCESS]]></return_code></xml>
 * Or string followed while false
 *    <xml><return_code><![CDATA[FAIL]]></return_code></xml>
 */
$complete_response->getResponseText();
```

Or use it as follow. But example above is recommended.
```php
use Omnipay\Omnipay;

$request_content = file_get_contents('php://input');
$request_params = json_decode(json_encode(simplexml_load_string($request->getContent(), 'SimpleXMLElement', LIBXML_NOCDATA)), true);

$gateway = Omnipay::create( 'WechatPay' );
$gateway->setKey( 'Your key for WeChat payment here.' );

$complete_request = $gateway->completeOrder(array( 
  'request_params' => $request_params 
));

$complete_response = $complete_request->send();
$complete_response->isResultSuccessful();
$complete_response->isResponseSuccessful();
$complete_response->getResponseText();
```

### Refund
```php
use Omnipay\Omnipay;

$gateway = Omnipay::create( 'Your appid here.' );
$gateway->setAppId( 'Your appid here.' );
$gateway->setMchId( 'Your mch_id here.' );
$gateway->setKey( 'Your key for WeChat payment here.' );

$request = $gateway->createRefund([
    'ssl_cert_path'     =>  storage_path() . '/cert/apiclient_cert.pem',
    'ssl_key_path'      =>  storage_path() . '/cert/apiclient_key.pem',
    'transaction_id'    =>  '111111111111',
    'out_trade_no'      =>  '222222222222',
    'out_refund_no'     =>  '333333333333',
    'total_fee'         =>  50,
    'refund_fee'        =>  20,
    'op_user_id'        =>  'Your mch_id here.'
]);

$response = $request->send();
$response->isResponseSuccessful();
$response->isSignatureMatched();
$response->isResultSuccessful();
```

### Query refund
```php
use Omnipay\Omnipay;

$gateway = Omnipay::create( 'WechatPay' );
$gateway->setAppId( 'Your appid here.' );
$gateway->setMchId( 'Your mch_id here.' );
$gateway->setKey( 'Your key for WeChat payment here.' );

/**
 * One of 'transaction_id', 'out_trade_no', 'out_refund_no', 'refund_id' is required
 */
$request = $gateway->queryRefund([
    'transaction_id'    => '11111111',
    'out_trade_no'      => '22222222',
    'out_refund_no'     => '33333333',
    'refund_id'         => '44444444'
]);

$response = $request->send();
$response->isResultSuccessful();
$response->isResponseSuccessful();
$response->isSignatureMatched();
$response->getTransactionId();
$response->getOutTradeNo();
$response->getRefundFee();
$response->getRefundCount();
$response->getNthOutRefundNo( N );      // 0 <= N < getRefundCount()
$response->getNthRefundId( N );         // 0 <= N < getRefundCount()
$response->getNthRefundFee( N );        // 0 <= N < getRefundCount()
$response->getNthRefundStatus( N );     // 0 <= N < getRefundCount()
$response->getNthRefundChannel( N );    // 0 <= N < getRefundCount()
```
