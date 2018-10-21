<?php

/**
 * Created by PhpStorm.
 * User: Jurgen Coetsiers
 * Date: 21/10/2018
 * Time: 09:09
 */

class ZoneSettingsTest extends TestCase
{
    public function testEnableTLS13()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/enableTLS13.json');

        $mock = $this->getMockBuilder(\Cloudflare\API\Adapter\Adapter::class)->getMock();
        $mock->method('patch')->willReturn($response);

        $mock->expects($this->once())
            ->method('patch')
            ->with(
                $this->equalTo('zones/c2547eb745079dac9320b638f5e225cf483cc5cfdda41/settings/tls_1_3'),
                $this->equalTo(['value' => 'on'])
            );

        $zoneSettings = new \Cloudflare\API\Endpoints\ZoneSettings($mock);
        $result = $zoneSettings->enableTLS13('c2547eb745079dac9320b638f5e225cf483cc5cfdda41', true);

        $this->assertTrue($result);
    }


}
