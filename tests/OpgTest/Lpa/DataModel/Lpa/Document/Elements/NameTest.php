<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document\Elements;

use OpgTest\Lpa\DataModel\FixturesData;

class NameTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $donor = FixturesData::getDonor();
        $name = $donor->get('name');

        $this->assertEquals('Hon Ayden Armstrong', '' . $name);
    }
}