<?php

namespace Omnipay\WechatPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 *  下载对账单
 */
class DownloadBillRequest extends BaseAbstractRequest{

    protected $interface_url = 'https://api.mch.weixin.qq.com/pay/downloadbill';

    protected function validateData(){

        parent::validateData();

        $this->validate(
            'bill_date'
        );
    }

    public function getData(){

        $this->validateData();

        $request_data = [
            'appid'             => $this->getAppId(),
            'mch_id'            => $this->getMchId(),
            'nonce_str'         => $this->getNonceStr(),
            'device_info'       => $this->getDeviceInfo(),
            'bill_date'         => $this->getBillDate(),
            'bill_type'         => $this->getBillType()
        ];

        $request_data = array_filter( $request_data, function( $value ){

            return !is_null( $value );
        });

        $request_data['sign'] = $this->getParamsSignature( $request_data, $this->getKey() );

        return $request_data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData( $data ){

        // 将数组转换成xml，发送请求
        $result = $this->postXmlCurl( $this->convertArrayToXml( $data ), $this->getInterfaceUrl() );
        
        libxml_use_internal_errors(true);

        // To xml
        $result_parsed = simplexml_load_string( $result, 'SimpleXMLElement', LIBXML_NOCDATA );

        // Successfully convert to xml
        if ( $result_parsed ){

            // To array
            $result_parsed = json_decode( json_encode( $result_parsed ), true );

            $this->response = new DownloadBillResponse( $this, $result_parsed );
        }
        // Failed to convert 
        else{

            $this->response = new DownloadBillResponse( $this, [
                'return_code'   => 'SUCCESS',
                'bill'          => $result
            ]);
        }

        return $result;
    }

    public function setAppId( $value ){

        return $this->setParameter( 'appid', $value );
    }

    public function getAppId( ){

        return $this->getParameter( 'appid' );
    }

    public function setMchId( $value ){

        return $this->setParameter( 'mch_id', $value );
    }

    public function getMchId( ){

        return $this->getParameter( 'mch_id' );
    }

    public function setKey( $value ){

        return $this->setParameter( 'key', $value );
    }

    public function getKey(){
        
        return $this->getParameter( 'key' );
    }

    public function setDeviceInfo( $value ){

        return $this->setParameter( 'device_info', $value );
    }

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function setBillDate( $value ){

        return $this->setParameter( 'bill_date', $value );
    }

    public function getBillDate(){

        return $this->getParameter( 'bill_date' );
    }

    public function setBillType( $value ){

        return $this->setParameter( 'bill_type', $value );
    }

    public function getBillType(){

        return $this->getParameter( 'bill_type' );
    }
}
