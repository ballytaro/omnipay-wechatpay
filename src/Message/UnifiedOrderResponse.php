<?php

namespace Omnipay\WechatPay\Message;

use \Omnipay\Common\Exception\InvalidResponseException;

class UnifiedOrderResponse extends BaseAbstractResponse{

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function getAttach(){

        return $this->getParameter( 'attach' );
    }

    public function getOpenId(){

        return $this->getParameter( 'openid' );
    }

    public function getTradeType(){

        return $this->getParameter( 'trade_type' );
    }

    public function getFeeType( $value ){

        return $this->getParameter( 'fee_type' );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }
   
    public function getPrepayId(){

        return $this->getParameter( 'prepay_id' );
    }

    public function getCodeUrl(){

        return $this->getParameter( 'code_url' );
    }

    public function createWebPaymentPackage(){
       
        if ( !$this->is_result_successful ){
            
            throw new InvalidResponseException( 'Could not create web payment package from invalid response.' ); 
        }
        
        $params = [
            'appId' => $this->getAppId(),
            'timeStamp' => time(),
            'nonceStr' => $this->getNonceStr(),
            'package' => 'prepay_id=' . $this->getPrepayId(),
            'signType' => 'MD5'
        ];

        $params['paySign'] = $this->getParamsSignature( $params, $this->request->getKey() );

        return $params;
    }
}
