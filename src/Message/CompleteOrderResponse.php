<?php

namespace Omnipay\WechatPay\Message;

class CompleteOrderResponse extends BaseAbstractResponse{


    use \Omnipay\WechatPay\Traits\XMLTrait;
    
    public function getResponseText(){
        
        $response_content = [
            'return_code' => $this->isResultSuccessful() ? 'SUCCESS' : 'FAIL'
        ];

        return $this->convertArrayToXml( $response_content );
    }

    public function isSubscribe(){

        $is_subscribe = $this->getParameter( 'is_subscribe' );

        if ( is_null( $is_subscribe ) ){

            return null;
        }

        return $this->getParameter( 'is_subscribe' ) == 'Y';
    }

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function getOpenId(){

        return $this->getParameter( 'openid' );
    }

    public function getTradeType(){

        return $this->getParameter( 'trade_type' );
    }

    public function getBankType(){

        return $this->getParameter( 'bank_type' );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function getFeeType(){

        return $this->getParameter( 'fee_type' );
    }

    public function getCashFee(){

        return $this->getParameter( 'cash_fee' );
    }

    public function getCashFeeType(){

        return $this->getParameter( 'cash_fee_type' );
    }

    public function getTransactionId(){

        return $this->getParameter( 'transaction_id' );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function getAttach(){

        return $this->getParameter( 'attach' );
    }

    public function getTimeEnd(){

        return $this->getParameter( 'time_end' );
    }

    public function getCouponFee(){

        return $this->getParameter( 'coupon_fee' );
    }

    public function getCouponCount(){

        return $this->getParameter( 'coupon_count' );
    }

    public function getNthCouponId( $n ){

        return $this->getParameter( 'coupon_id'.'_'.$n );
    }

    public function getNthCouponFee( $n ){

        return $this->getParameter( 'coupon_fee'.'_'.$n );
    }
}
