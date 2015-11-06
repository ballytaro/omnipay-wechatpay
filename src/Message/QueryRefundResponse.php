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

    public function getOpenId(){

        return $this->getParameter( 'openid', $value );
    }

    public function getTradeType(){

        return $this->getParameter( 'trade_type' );
    }

    public function getTradeState(){

        return $this->getParameter( 'trade_state' );
    }

    public function getFeeType( $value ){

        return $this->getParameter( 'fee_type' );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function getBankType(){

        return $this->getParameter( 'bank_type' );
    }

    public function getCashFee(){

        return $this->getCashFee( 'cash_fee' );
    }

    public function getCashFeeType(){

        return $this->getParameter( 'cash_fee_type' );
    }

    public function getCouponFee(){

        return $this->getParameter( 'coupon_fee' );
    }

    public function getCouponCount(){

        return $this->getParameter( 'coupon_count' );
    }

    public function getCouponBatchId( $n ){

        return $this->getParameter( 'coupon_batch_id_'.$n );
    }

    public function getCouponId( $n ){

        return $this->getParameter( 'coupon_id_'.$n );
    }

    public function getSingleCouponFee( $n ){

        return $this->getParameter( 'coupon_fee_'.$n );
    }

    public function getTransactionId(){

        return $this->getParameter( 'transaction_id' );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }
   
    public function getTradeType(){

        return $this->getParameter( 'trade_type' );
    }

    public function getTimeEnd(){

        return $this->getParameter( 'time_end' );
    }

    public function getTradeStateDesc(){

        return $this->getParameter( 'trade_state_desc' );
    }

    public function getRefundCount(){

        return $this->getParameter( 'refund_count' );
    }

    public function getOutRefundNo( $n ){

        return $this->getParameter( 'out_refund_no'.'_'.$n );
    }

    public function getRefundId( $n ){

        return $this->getParameter( 'refund_id'.'_'.$n );
    }

    public function getRefundChannel( $n ){

        return $this->getParameter( 'refund_channel'.'_'.$n );
    }

    public function getRefundFee( $n ){

        return $this->getParameter( 'refund_fee'.'_'.$n );
    }

    public function getCouponRefundFee( $n ){

        return $this->getParameter( 'coupon_refund_fee'.'_'.$n );
    }

    public function getCouponRefundCount( $n ){

        return $this->getParameter( 'coupon_refund_count'.'_'.$n );
    }

    public function getCouponRefundBatchId( $n, $m ){

        return $this->getParameter( 'coupon_refund_batch_id'.'_'.$n.'_'.$m );
    }

    public function getCouponRefundId( $n, $m ){

        return $this->getParameter( 'coupon_refund_id'.'_'.$n.'_'.$m );
    }

    public function getCouponRefundFee( $n, $m ){

        return $this->getParameter( 'coupon_refund_fee'.'_'.$n.'_'.$m );
    }

    public function getRefundStatus( $n ){

        return $this->getParameter( 'refund_status'.'_'.$n );
    }
}
