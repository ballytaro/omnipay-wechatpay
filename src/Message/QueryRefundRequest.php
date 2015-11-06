<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class QueryRefundRequest extends BaseAbstractRequest{

    protected $interface_url = 'https://api.mch.weixin.qq.com/pay/refundquery';

    protected function validateData(){

        parent::validateData();

        /*
         * transaction_id, out_trade_no, out_refund_no, refund_id至少需要一个
         */
        $this->validateAtLeastOne(
            'transaction_id', 'out_trade_no', 'out_refund_no', 'refund_id'
        );
    }

    public function getData(){

        $this->validateData();

        $request_data = [
            'appid'             => $this->getAppId(),
            'mch_id'            => $this->getMchId(),
            'transaction_id'    => $this->getTransactionId(),
            'out_trade_no'      => $this->getOutTradeNo(),
            'out_refund_no'     => $this->getOutRefundNo(),
            'refund_id'         => $this->getRefundId(),
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

        return $this->response = new QueryRefundResponse( $this, $result );
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

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function setOutRefundNo( $value ){

        return $this->setParameter( 'out_refund_no', $value );
    }

    public function setTransactionId( $value ){

        return $this->setParameter( 'transaction_id', $value );
    }

    public function getTransactionId(){

        return $this->getTransactionId( 'transaction_id' );
    }

    public function setRefundId( $value ){

        return $this->setParameter( 'refund_id', $value );
    }

    public function getRefundId(){

        return $this->getParameter( 'refund_id' );
    }
}
