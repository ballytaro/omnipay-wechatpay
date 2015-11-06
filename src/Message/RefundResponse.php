<?php

namespace Omnipay\WechatPay\Message;

class RefundResponse extends BaseAbstractResponse{

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function getTransactionId(){

        return $this->getTransactionId( 'transaction_id' );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function getOutRefundNo(){

        return $this->getParameter( 'out_refund_no' );
    }

    public function getRefundId(){

        return $this->getParameter( 'refund_id' );
    }

    public function getRefundChannel(){

        return $this->setParameter( 'refund_channel' );
    }

    public function getRefundFee(){

        return $this->getParameter( 'refund_fee' );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function getFeeType(){

        return $this->getParameter();
    }

    public function getCashFee(){

        return $this->getParameter( 'cash_fee' );
    }

    public function getCashRefundFee(){

        return $this->getParameter( 'cash_refund_fee' );
    }

    public function getCouponRefundFee(){

        return $this->getParameter( 'coupon_refund_fee' );
    }

    public function getCouponRefundCount(){

        return $this->getParameter( 'coupon_refund_count' );
    }

    public function getCouponRefundId(){

        return $this->getParameter( 'coupon_refund_id' );
    }
}
