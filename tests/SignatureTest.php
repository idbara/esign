<?php

namespace Esign\Tests;

use Esign\Exceptions\ApiException;
use Esign\Signature;
use GuzzleHttp\Exception\GuzzleException;

class SignatureTest extends TestCase
{

    /**
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testSign()
    {
        $params = array(
            'file' => fopen('./tte-test.pdf', 'r'),
            'nik' => '',
            'passphrase' => '',
            'tampilan' => 'VISIBLE',
            'height' => '195',
            'width' => '100',
            'linkQR' => 'https://simpeg.pemalangkab.go.id/publik/verifikasi/531ea4817dbf1bb2155bbd1f3443d767',
            'tag_koordinat' => '#'
        );
        $response = Signature::sign($params);
//        fwrite(STDERR, print_r($response, TRUE));
        file_put_contents('tte-test-signed.pdf', $response['body']);
        $this->assertArrayHasKey('status_code', $response);
        $this->assertEquals(200, $response['status_code']);
    }

    /**
     * Test verify signature
     *
     * @throws ApiException
     * @throws GuzzleException
     */
    public function testVerify()
    {
        $params = array(
            'signed_file' => fopen('./tte-test-signed.pdf', 'r'),
        );

        $response = Signature::verify($params);
//        fwrite(STDERR, print_r($response, TRUE));
        $this->assertArrayHasKey('status_code', $response);
        $this->assertEquals(200, $response['status_code']);
    }
}
