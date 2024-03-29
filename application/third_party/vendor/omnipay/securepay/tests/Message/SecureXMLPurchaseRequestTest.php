<?php

namespace Omnipay\SecurePay\Message;

use Omnipay\Tests\TestCase;

class SecureXMLPurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new SecureXMLPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->request->initialize(
            array(
                'merchantId' => 'ABC0030',
                'transactionPassword' => 'abc123',
                'amount' => '12.00',
                'transactionId' => '1234',
                'card' => array(
                    'number' => '4444333322221111',
                    'expiryMonth' => '10',
                    'expiryYear' => '2020',
                    'cvv' => '123',
                ),
            )
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('SecureXMLPurchaseRequestSendSuccess.txt');
        $response = $this->request->send();
        $data = $response->getData();

        $this->assertInstanceOf('Omnipay\\SecurePay\\Message\\SecureXMLResponse', $response);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('0', (string)$data->Payment->TxnList->Txn->txnType);
        $this->assertSame('009729', $response->getTransactionReference());
        $this->assertSame('00', $response->getCode());
        $this->assertSame('Approved', $response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('SecureXMLPurchaseRequestSendFailure.txt');
        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\\SecurePay\\Message\\SecureXMLResponse', $response);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('510', $response->getCode());
        $this->assertSame('Unable To Connect To Server', $response->getMessage());
    }

    public function testInsufficientFundsFailure()
    {
        $this->setMockHttpResponse('SecureXMLPurchaseRequestInsufficientFundsFailure.txt');
        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\\SecurePay\\Message\\SecureXMLResponse', $response);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('51', $response->getCode());
        $this->assertSame('Insufficient Funds', $response->getMessage());
    }
}
