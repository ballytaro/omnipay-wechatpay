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
$gateway->setAttach( 'test );
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
$complete_response->isSuccessful();

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
$complete_response->isSuccessful();

$complete_response->getResponseText();
```
