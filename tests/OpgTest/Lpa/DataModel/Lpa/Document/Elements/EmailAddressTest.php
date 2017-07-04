<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document\Elements;

use OpgTest\Lpa\DataModel\FixturesData;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $donor = FixturesData::getDonor();
        $email = $donor->get('email');

        $this->assertEquals('92zx2n1nk@wx.co.uk', '' . $email);
    }
}