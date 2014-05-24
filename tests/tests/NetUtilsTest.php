<?php
namespace MarketMeSuite\Phranken\Util;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-08-24 at 03:47:34.
 */
class NetUtilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers MarketMeSuite\Phranken\Util\NetUtils::urlIsReachable
     */
    public function testUrlIsReachable()
    {
        $expected = true;
        $actual = NetUtils::urlIsReachable('http://marketmesuite.com/');
        $this->assertSame($expected, $actual);

        $expected = false;
        $actual = NetUtils::urlIsReachable('http://marketmesuite-doesnotexist.com/');
        $this->assertSame($expected, $actual);

        $expected = false;
        $actual = NetUtils::urlIsReachable('http://marketmesuite.com/thispagedoesnotexist');
        $this->assertSame($expected, $actual);
    }
}
