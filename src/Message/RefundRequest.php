<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RefundRequest extends BaseAbstractRequest{

    protected $interface_url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';

    protected function validateData(){

        parent::validateData();

        $this->validate(
            'out_refund_no',
            'total_fee',
            'refund_fee',
            'op_user_id',
            'ssl_cert_path',
            'ssl_key_path'
        );

        /*
         * transaction_id和out_trade_no至少需要一个，
         * 同时存在时transaction_id优先
         */
        $this->validateAtLeastOne( 'transaction_id', 'out_trade_no' );
    }

    public function getData(){

        $this->validateData();

        $request_data = [
            'appid'             => $this->getAppId(),
            'mch_id'            => $this->getMchId(),
            'nonce_str'         => $this->getNonceStr(),
            'out_trade_no'      => $this->getOutTradeNo(),
            'transaction_id'    => $this->getTransactionId(),
            'out_refund_no'     => $this->getOutRefundNo(),
            'total_fee'         => $this->getTotalFee(),
            'refund_fee'        => $this->getRefundFee(),
            'refund_fee_type'   => $this->getRefundFeeType(),
            'op_user_id'        => $this->getOpUserId()
        ];

        $request_data = array_filter( $request_data, function( $value ){

            return !is_null( $value );
        });
        
        $request_data['sign'] = $this->getParamsSignature( $request_data, $this->getKey() );

        return $request_data;
    }

    public function sendData( $data ){

        $curl_options = [
            'cert'          => true,
            'ssl_cert_path' => $this->getSslCertPath(),
            'ssl_key_path'  => $this->getSslKeyPath() 
        ];

        $result = parent::sendData( $data, $curl_options );
        
        return $this->response =  new RefundResponse( $this, $result );
    }

    public function setSslCertPath( $value ){
        
        return $this->setParameter( 'ssl_cert_path', $value );
    }

    public function getSslCertPath(){
        
        return $this->getParameter( 'ssl_cert_path' );
    }

    public function setSslKeyPath( $value ){

        return $this->setParameter( 'ssl_key_path', $value );
    }

    public function getSslKeyPath(){

        return $this->getParameter( 'ssl_key_path' );
    }

    public function setAppId( $value ){

        return $this->setParameter( 'appid', $value );
    }

    public function getAppId( ){

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

    public function setOutTradeNo( $value ){

        return $this->setParameter( 'out_trade_no', $value );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function setOutRefundNo( $value ){

        return $this->setParameter( 'out_refund_no', $value );
    }

    public function getOutRefundNo(){

        return $this->getParameter( 'out_refund_no' );
    }

    public function setTransactionId( $value ){

        return $this->setParameter( 'transaction_id', $value );
    }

    public function getTransactionId(){

        return $this->getParameter( 'transaction_id' );
    }

    public function setTotalFee( $value ){

        return $this->setParameter( 'total_fee', $value );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function setRefundFee( $value ){

        return $this->setParameter( 'refund_fee', $value );
    }

    public function getRefundFee(){

        return $this->getParameter( 'refund_fee' );
    }

    public function setRefundFeeType( $value ){

        return $this->setParameter( 'refund_fee_type', $value );
    }

    public function getRefundFeeType(){

        return $this->getParameter( 'refund_fee_type' );
    }

    public function setDeviceInfo( $value ){

        return $this->setParameter( 'device_info', $value );
    }

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function setOpUserId( $value ){

        return $this->setParameter( 'op_user_id', $value );
    }

    public function getOpUserId(){

        return $this->getParameter( 'op_user_id' );
    }
}
