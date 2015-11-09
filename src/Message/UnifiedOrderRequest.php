<?php

namespace Omnipay\WechatPay\Message;

class UnifiedOrderRequest extends BaseAbstractRequest{

    protected $interface_url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

    protected function validateData(){

        parent::validateData();

        $this->validate(
            'body',
            'out_trade_no',
            'total_fee',
            'spbill_create_ip',
            'notify_url',
            'trade_type'
        );

        $trade_type = $this->getTradeType();

        // 交易类型为JSAPI时，openid参数必须
        if ( $trade_type == 'JSAPI' ){

            $this->validate( 'openid' );
        }

        // 交易类型为NATIVE时，product_id参数必须
        if ( $trade_type == 'NATIVE' ){

            $this->validate( 'product_id' );
        }
    }

    public function getData(){

        $this->validateData();

        $request_data = [
            'appid'             => $this->getAppId(),
            'mch_id'            => $this->getMchId(),
            'device_info'       => $this->getDeviceInfo(),
            'nonce_str'         => $this->getNonceStr(),
            'body'              => $this->getBody(),
            'detail'            => $this->getDetail(),
            'attach'            => $this->getAttach(),
            'out_trade_no'      => $this->getOutTradeNo(),
            'fee_type'          => $this->getFeeType(),
            'total_fee'         => $this->getTotalFee(),
            'spbill_create_ip'  => $this->getSpbillCreateIP(),
            'time_start'        => $this->getTimeStart(),
            'time_expire'       => $this->getTimeExpire(),
            'goods_tag'         => $this->getGoodsTag(),
            'notify_url'        => $this->getNotifyUrl(),
            'trade_type'        => $this->getTradeType(),
            'product_id'        => $this->getProductId(),
            'limit_pay'         => $this->getLimitPay(),
            'openid'            => $this->getOpenId()
        ];

        $request_data = array_filter( $request_data, function( $value ){

            return !is_null( $value );
        });

        $request_data['sign'] = $this->getParamsSignature( $request_data, $this->getKey() );
        
        return $request_data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData( $data ){

        $result = parent::sendData( $data );

        return $this->response = new UnifiedOrderResponse( $this, $result );
    }

    public function setAppId( $value ){

        return $this->setParameter( 'appid', $value );
    }

    public function getAppId(){

        return $this->getParameter( 'appid' );
    }

    public function setMchId( $value ){

        return $this->setParameter( 'mch_id', $value );
    }

    public function getMchId( ){

        return $this->getParameter( 'mch_id' );
    }

    public function setKey( $value ){

        return $this->setParameter( 'key', $value );
    }

    public function getKey(){

        return $this->getParameter( 'key' );
    }

    public function setDeviceInfo( $value ){

        return $this->setParameter( 'device_info', $value );
    }

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function setAttach( $value ){

        return $this->setParameter( 'attach', $value );
    }

    public function getAttach(){

        return $this->getParameter( 'attach' );
    }

    public function setOpenId( $value ){

        return $this->setParameter( 'openid', $value );
    }

    public function getOpenId(){

        return $this->getParameter( 'openid' );
    }

    public function setTradeType( $value ){

        return $this->setParameter( 'trade_type', $value );
    }

    public function getTradeType(){

        return $this->getParameter( 'trade_type' );
    }

    public function setFeeType( $value ){

        return $this->setParameter( 'fee_type', $value );
    }

    public function getFeeType(){

        return $this->getParameter( 'fee_type' );
    }

    public function setTotalFee( $value ){

        return $this->setParameter( 'total_fee', $value );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function setOutTradeNo( $value ){

        return $this->setParameter( 'out_trade_no', $value );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function setBody( $value ){

        return $this->setParameter( 'body', $value );
    }

    public function getBody(){

        return $this->getParameter( 'body' );
    }

    public function setDetail( $value ){

        return $this->setParameter( 'detail', $value );
    }

    public function getDetail(){

        return $this->getParameter( 'detail' );
    }

    public function setSpbillCreateIP( $value ){

        return $this->setParameter( 'spbill_create_ip', $value );
    }

    public function getSpbillCreateIP(){

        return $this->getParameter( 'spbill_create_ip' );
    }

    public function setTimeStart( $value ){

        return $this->setParameter( 'time_start', $value );
    }

    public function getTimeStart(){

        return $this->getParameter( 'time_start' );
    }

    public function setTimeExpire( $value ){

        return $this->setParameter( 'time_expire', $value );
    }

    public function getTimeExpire(){

        return $this->getParameter( 'time_expire' );
    }

    public function setGoodsTag( $value ){

        return $this->setParameter( 'goods_tag', $value );
    }

    public function getGoodsTag(){

        return $this->getParameter( 'goods_tag' );
    }

    public function setNotifyUrl( $value ){

        return $this->setParameter( 'notify_url', $value );
    }

    public function getNotifyUrl(){

        return $this->getParameter( 'notify_url' );
    }

    public function setProductId( $value ){

        return $this->setParameter( 'product_id', $value );
    }

    public function getProductId(){

        return $this->getParameter( 'product_id' );
    }

    public function setLimitPay( $vlaue ){

        return $this->setParameter( 'limit_pay', $value );
    }

    public function getLimitPay(){

        return $this->getParameter( 'limit_pay' );
    }  
}
