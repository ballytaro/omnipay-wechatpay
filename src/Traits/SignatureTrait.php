<?php

namespace Omnipay\WechatPay\Traits;

trait SignatureTrait{

    /**
     * 根据$data参数生成签名
     * @see     https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_3
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
}
