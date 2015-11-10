<?php

namespace Omnipay\WechatPay;

use Omnipay\Common\AbstractGateway;

/**
 * WechatPay Base Gateway Class
 */
class Gateway extends AbstractGateway {

    use \Omnipay\WechatPay\Traits\XMLTrait;
    
    public function getName(){

        return $this->getTradeType();
    }

    public function getDefaultParameters(){

        return [
            'appid'     => '',
            'mch_id'    => '',
        ];
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

    public function setBody( $value ){

        return $this->setParameter( 'body', $value );
    }

    public function getBody( ){

        return $this->getParameter( 'body' );
    }

    public function setDeviceInfo( $value ){

        return $this->setParameter( 'device_info', $value );
    }

    public function getDeviceInfo(){

        return $this->getParameter( 'device_info' );
    }

    public function setDetail( $value ){

        return $this->setParameter( 'detail', $value );
    }

    public function getDetail(){

        return $this->getParameter( 'detail' );
    }

    public function setAttach( $value ){

        return $this->setParameter( 'attach', $value );
    }

    public function getAttach(){

        return $this->getParameter( 'attach' );
    }

    public function setOutTradeNo( $value ){

        return $this->setParameter( 'out_trade_no', $value );
    }

    public function getOutTradeNo(){

        return $this->getParameter( 'out_trade_no' );
    }

    public function setFeeType( $value ){

        return $this->setParameter( 'fee_type', $value );
    }

    public function getFeeType(){

        return $this->getParameter( 'fee_type' );
    }

    public function setTotalFee( $value ){

        return $this->setParameter( 'total_fee', $value );
    }

    public function getTotalFee(){

        return $this->getParameter( 'total_fee' );
    }

    public function setSpbillCreateIP( $value ){

        return $this->setParameter( 'spbill_create_ip', $value );
    }

    public function getSpbillCreateIP(){

        return $this->getParameter( 'spbill_create_ip' );
    }

    public function setTimeStart( $value ){

        return $this->setParameter( 'time_start', $value );
    }

    public function getTimeStart(){

        return $this->getParameter( 'time_start' );
    }

    public function setTimeExpire( $value ){

        return $this->setParameter( 'time_expire', $value );
    }

    public function getTimeExpire(){

        return $this->getParameter( 'time_expire' );
    }

    public function setGoodsTag( $value ){

        return $this->setParameter( 'goods_tag', $value );
    }

    public function getGoodsTag(){

        return $this->getParameter( 'goods_tag' );
    }

    public function setNotifyUrl( $value ){

        return $this->setParameter( 'notify_url', $value );
    }

    public function getNotifyUrl(){

        return $this->getParameter( 'notify_url' );
    }

    public function setTradeType( $value ){

        return $this->setParameter( 'trade_type', $value );
    }

    public function getTradeType(){

        return $this->getParameter( 'trade_type' );
    }

    public function setProductId( $value ){

        return $this->setParameter( 'product_id', $value );
    }

    public function getProductId(){

        return $this->getParameter( 'product_id' );
    }

    public function setLimitPay( $value ){

        return $this->setParameter( 'limit_pay', $value );
    }

    public function getLimitPay(){

        return $this->getParameter( 'limit_pay' );
    }

    public function setOpenId( $value ){

        return $this->setParameter( 'openid', $value );
    }

    public function getOpenId(){

        return $this->getParameter( 'openid' );
    }
    
    /**
     * 统一下单请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function createUnifiedOrder( $parameters = array() ){

        return $this->createRequest( '\Omnipay\WechatPay\Message\UnifiedOrderRequest', $parameters );
    }

    /**
     * 异步通知处理请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function completeOrder( $parameters = array() ){ 

        if ( is_string( $parameters ) ){
        
            $parameters = $this->convertXmlToArray( $parameters );
        }

        return $this->createRequest( '\Omnipay\WechatPay\Message\CompleteOrderRequest', $parameters );
    }

    /**
     * 查询订单请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function queryOrder( $parameters = array() ){

        return $this->createRequest( '\Omnipay\WechatPay\Message\QueryOrderRequest', $parameters );
    }

    /**
     * 关闭订单请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function closeOrder( $parameters = array() ){

        return $this->createRequest( '\Omnipay\WechatPay\Message\CloseOrderRequest', $parameters );
    }

    /**
     * 退款请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function createRefund( $parameters = array() ){

        return $this->createRequest( '\Omnipay\WechatPay\Message\RefundRequest', $parameters );
    }

    /**
     * 查询退款请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function queryRefund( $parameters = array() ){

        return $this->createRequest( '\Omnipay\WechatPay\Message\QeuryRefundRequest', $parameters );
    }

    /**
     * 下载对账单请求
     * 
     * @param   array               $parameters
     * @return  RequestInterface    
     */
    public function downloadBill( $parameters = array() ){

        return $this->createRequest( '\Omnipay\WechatPay\Message\DownloadBillRequest', $parameters );
    }
}
