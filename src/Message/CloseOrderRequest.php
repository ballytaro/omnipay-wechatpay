<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CloseOrderRequest extends BaseAbstractRequest{

    protected $interface_url = 'https://api.mch.weixin.qq.com/pay/closeorder';

    protected function validateData(){

        parent::validateData();

        $this->validate(
            'out_trade_no'
        );
    }

    public function getData(){

        $this->validateData();

        $request_data = [
            'appid'             => $this->getAppId(),
            'mch_id'            => $this->getMchId(),
            'out_trade_no'      => $this->getOutTradeNo(),
            'nonce_str'         => $this->getNonceStr()
        ];

        $request_data = array_filter( $request_data, function( $value ){

            return !is_null( $value );
        });

        $request_data['sign'] = $this->getParamsSignature( $request_data );

        return $request_data;
    }

    public function sendData( $data ){

        $result = parent::sendData( $data );

        return $this->response = new CloseOrderResponse( $this, $result );
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

    public function setOutTradeNo( $value ){

        return $this->setParameter( 'out_trade_no', $value );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }
}
