<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Message\AbstractResponse;

abstract class BaseAbstractResponse extends AbstractResponse{

    /**
     * 根据$data参数生成签名
     * 签名算法见: https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_3
     * 
     * @param   $data   array
     * 
     * @return  string
     */
    protected function getParamsSignature( $data, $key ){

        ksort( $data );

        $string = $this->getSignString( $data, $key );

        return strtoupper( md5( $string ) );
    }

    /**
     * 生成待签名字符串
     * 
     * @param   $data   array
     *
     * @return  string
     */
    protected function getSignString( $data, $key ){

        $buff = "";
        
        foreach ( $data as $k => $v ){

            if( $k != 'sign' && $v != "" && !is_array( $v ) ){

                $buff .= $k . '=' . $v . '&';
            }
        }
        
        return $buff . 'key=' . $key;
    }

    public function getParameter( $key ){

        return array_key_exists( $key, $this->data ) ? $this->data[$key] : null;
    }

    public function isSuccessful(){

        return $this->getParameter( 'return_code' ) == 'SUCCESS';
    }

    public function isSignMatch(){

        return $this->getParamsSignature( $this->getData() ) == $this->getSign();
    }

    public function isResultSuccessful(){

        return $this->isSuccessful() && $this->isSignMatch() && $this->getResultCode() == 'SUCCESS';
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
