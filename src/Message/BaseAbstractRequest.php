<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Exception\InvalidRequestException;

abstract class BaseAbstractRequest extends AbstractRequest{

    use \Omnipay\WechatPay\Traits\SignatureTrait;
    use \Omnipay\WechatPay\Traits\XMLTrait;

    /**
     * 验证appid，mch_id
     */
    protected function validateData(){

        $this->validate(
            'appid',
            'mch_id',
            'key'
        );
    }

    /**
     * 验证参数中是否至少存在一个
     */
    protected function validateAtLeastOne(){

        $keys = func_get_args();

        foreach ( $keys as $key ){
                
            if ( !empty( $this->getParameter( $key ) ) ){

                return true;
            }
        }

        throw new InvalidRequestException( 'Require one of parameters in '.join( ', ', $keys ) );
    }

    /**
     * 获取接口url，子类中定义interface_url
     * 
     * @return string
     */
    public function getInterfaceUrl(){

        return $this->interface_url;
    }

    /**
     * 发送请求，响应解析为数组后返回
     * 
     * @param   array $data
     * @param   array $curl_options
     * @return  array 
     */
    public function sendData( $data, $curl_options = array() ){

        // 将数组转换成xml，发送请求
        $result = $this->postXmlCurl( $this->convertArrayToXml( $data ), $this->getInterfaceUrl(), $curl_options );
       
        // xml结果解析为数组
        $result = $this->convertXmlToArray( $result );

        return $result;
    }

    protected function getDefaultCurlOptions(){
        
        return [
            'cert'      => false,
            'proxy'     => false,
            'seconds'   => 30
        ];
    }

    /**
     * Extract from Wechat official sdk and modify it
     * 
     * 以post方式提交xml到对应的接口url
     * 
     * @param   string $xml       需要post的xml数据
     * @param   string $url       url
     * @param   array  $options   curl options
     * @return  string            xml数据格式字符串
     */
    protected function postXmlCurl( $xml, $url, $options = array() ){

        $ch = curl_init();

        // default options
        $default_options = $this->getDefaultCurlOptions(); 

        // merge options
        $options = array_merge( $default_options, $options );
        
        //设置超时
        curl_setopt( $ch, CURLOPT_TIMEOUT, $options['seconds'] );
        
        //如果有配置代理这里就设置代理
        if ( $options['proxy'] == true ){
            curl_setopt( $ch, CURLOPT_PROXY, $options['proxy_host'] );
            curl_setopt( $ch, CURLOPT_PROXYPORT, $options['proxy_port'] );
        }

        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, TRUE );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );//严格校验

        //设置header
        curl_setopt( $ch, CURLOPT_HEADER, FALSE );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );

        if( $options['cert'] == true ){
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt( $ch, CURLOPT_SSLCERTTYPE, 'PEM' );
            curl_setopt( $ch, CURLOPT_SSLKEYTYPE, 'PEM' );
            curl_setopt( $ch, CURLOPT_SSLCERT, $options['ssl_cert_path'] );
            curl_setopt( $ch, CURLOPT_SSLKEY, $options['ssl_key_path'] );
        }

        //post提交方式
        curl_setopt( $ch, CURLOPT_POST, TRUE );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );

        //运行curl
        $response = curl_exec( $ch );
        
        curl_close( $ch );

        return $response;
    }

    /**
     * 获取随机字符串
     * 
     * @param   string $size      返回的随机字符串长度
     * @return  string
     */
    protected function getNonceStr( $size = 32 ){

        $chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';

        $char_count = strlen( $chars );

        $nonce = '';

        for ( $i = 0; $i != $size; ++$i ){
            $nonce .= $chars[ rand( 0, $char_count - 1 ) ];
        }

        return $nonce;
    }
}
