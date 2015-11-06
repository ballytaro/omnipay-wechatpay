<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class QueryOrderRequest extends BaseAbstractRequest{

    protected $interface_url = 'https://api.mch.weixin.qq.com/pay/orderquery';

    protected function validateData(){

        parent::validateData();

        /*
         * transaction_id和out_trade_no至少需要一个，
         * 同时存在时transaction_id优先
         */
        try{
            if ( !$this->validate( 'transaction_id' ) ){

                $this->validate( 'out_trade_no' );
            }
        }
        catch( InvalidRequestException $e ){

            throw new InvalidRequestException( 'Require one of parameters "transaction_id" and "out_trade_no"' );
        }
    }

    public function getData(){

        $this->validateData();

        $request_data = [
            'appid'             => $this->getAppId(),
            'mch_id'            => $this->getMchId(),
            'transaction_id'    => $this->getTransactionId(),
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

        return $this->response = new QueryOrderResponse( $this, $result );
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

    public function setTransactionId( $value ){

        return $this->setParameter( 'transaction_id', $value );
    }

    public function getTransactionId(){

        return $this->getTransactionId( 'transaction_id' );
    }
}
