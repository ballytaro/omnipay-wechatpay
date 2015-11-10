<?php

namespace Omnipay\WechatPay\Message;

use \Omnipay\Common\Message\AbstractResponse;

abstract class BaseAbstractResponse extends AbstractResponse{

    use \Omnipay\WechatPay\Traits\SignatureTrait;

    public function initialize(){

        parent::initialize();
        
        $this->is_signature_matched = $this->getParamsSignature( $this->getData() ) == $ths->getSign();
        $this->is_response_successful = $this->getReturnCode() == 'SUCCESS';
        $this->is_result_successful = $this->is_signature_matched && $this->is_response_successful && 
                                      $this->getResultCode() == 'SUCCESS';
    }

    public function getParameter( $key ){

        return array_key_exists( $key, $this->data ) ? $this->data[$key] : null;
    }

    public function isSignatureMatched(){

        return $this->is_signature_matched;
    }

    public function isResponseSuccessful(){

        return $this->is_response_successful;
    }

    public function isResultSuccessful(){

        return $this->is_result_successful;
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
