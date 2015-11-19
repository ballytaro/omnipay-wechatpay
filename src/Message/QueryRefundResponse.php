<?php

namespace Omnipay\WechatPay\Message;

class QueryRefundResponse extends BaseAbstractResponse{

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

    public function getAttach(){

        return $this->getParameter( 'attach' );
    }

    public function getFeeType( $value ){

        return $this->getParameter( 'fee_type' );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function getCashFee(){

        return $this->getCashFee( 'cash_fee' );
    }

    public function getTransactionId(){

        return $this->getParameter( 'transaction_id' );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function getRefundFee(){

        return $this->getParameter( 'refund_fee' );
    } 
   
    public function getRefundCount(){

        return $this->getParameter( 'refund_count' );
    }

    public function getNthOutRefundNo( $n ){

        return $this->getParameter( 'out_refund_no'.'_'.$n );
    }

    public function getNthRefundId( $n ){

        return $this->getParameter( 'refund_id'.'_'.$n );
    }

    public function getNthRefundChannel( $n ){

        return $this->getParameter( 'refund_channel'.'_'.$n );
    }

    public function getNthRefundFee( $n ){

        return $this->getParameter( 'refund_fee'.'_'.$n );
    }

    public function getNthRefundStatus( $n ){

        return $this->getParameter( 'refund_status'.'_'.$n );
    }

    public function getNthCouponRefundFee( $n ){

        return $this->getParameter( 'coupon_refund_fee'.'_'.$n );
    }

    public function getNthCouponRefundCount( $n ){

        return $this->getParameter( 'coupon_refund_count'.'_'.$n );
    }

    public function getNthMthCouponRefundBatchId( $n, $m ){

        return $this->getParameter( 'coupon_refund_batch_id'.'_'.$n.'_'.$m );
    }

    public function getNthMthCouponRefundId( $n, $m ){

        return $this->getParameter( 'coupon_refund_id'.'_'.$n.'_'.$m );
    }

    public function getNthMthCouponRefundFee( $n, $m ){

        return $this->getParameter( 'coupon_refund_fee'.'_'.$n.'_'.$m );
    }
}
