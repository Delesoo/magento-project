<?php

namespace LaminasTest\OAuth\Signature;

use Laminas\OAuth\Signature;
use PHPUnit\Framework\TestCase;

class PlaintextTest extends TestCase
{
    public function testSignatureWithoutAccessSecretIsOnlyConsumerSecretString()
    {
        $params    = [
            'oauth_version'          => '1.0',
            'oauth_consumer_key'     => 'dpf43f3p2l4k3l03',
            'oauth_signature_method' => 'PLAINTEXT',
            'oauth_timestamp'        => '1191242090',
            'oauth_nonce'            => 'hsu94j3884jdopsl',
            'oauth_version'          => '1.0',
        ];
        $signature = new Signature\Plaintext('1234567890');
        $this->assertEquals('1234567890&', $signature->sign($params));
    }

    public function testSignatureWithAccessSecretIsConsumerAndAccessSecretStringsConcatWithAmp()
    {
        $params    = [
            'oauth_version'          => '1.0',
            'oauth_consumer_key'     => 'dpf43f3p2l4k3l03',
            'oauth_signature_method' => 'PLAINTEXT',
            'oauth_timestamp'        => '1191242090',
            'oauth_nonce'            => 'hsu94j3884jdopsl',
            'oauth_version'          => '1.0',
        ];
        $signature = new Signature\Plaintext('1234567890', '0987654321');
        $this->assertEquals('1234567890&0987654321', $signature->sign($params));
    }
}
