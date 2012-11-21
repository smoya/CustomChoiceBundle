<?php
namespace Smoya\Bundle\CustomChoiceBundle\Tests;

use Smoya\Bundle\CustomChoiceBundle\SmoyaCustomChoiceBundle;

class SmoyaCustomChoiceBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEnabled()
    {
        $bundle = new SmoyaCustomChoiceBundle();
        $this->assertInstanceOf('Symfony\Component\HttpKernel\Bundle\Bundle', $bundle);
    }
}
