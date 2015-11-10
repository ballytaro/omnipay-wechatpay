<?php

namespace Omnipay\WechatPay\Message;

use \Omnipay\Common\Message\AbstractResponse;

abstract class BaseAbstractResponse extends AbstractResponse{

    use \Omnipay\WechatPay\Traits\SignatureTrait;
    use \Omnipay\WechatPay\Traits\XMLTrait;

    public function getParameter( $key ){

        return array_key_exists( $key, $this->data ) ? $this->data[$key] : null;
    }

    public function isSignMatched(){

        return $this->getParamsSignature( $this->getData() ) == $this->getSign();
    }

    public function isResponseSuccessful(){

        return $this->getReturnCode() == 'SUCCESS';
    }

    public function isResultSuccessful(){

        return $this->isResponseSuccessful() && $this->isSignMatch() && $this->getResultCode() == 'SUCCESS';
    }

    public function getReturnCode(){

        return $this->getParameter( 'return_code' );
    }

    public function getReturnMsg(){

        return $this->getParameter( 'return_msg' );
    }

    public function getAppId(){

        return $this->getParameter( 'appid' );
    }

    public function getMchId(){

        return $this->getParameter( 'mch_id' );
    }

    public function getNonceStr(){

        return $this->getParameter( 'nonce_str' );
    }

    public function getSign(){

        return $this->getParameter( 'sign' );
    }

    public function getResultCode(){

        return $this->getParameter( 'result_code' );
    }

    public function getErrCode(){

        return $this->getParameter( 'err_code' );
    }

    public function getErrCodeDes(){

        return $this->getParameter( 'err_code_des' );
    }
}
