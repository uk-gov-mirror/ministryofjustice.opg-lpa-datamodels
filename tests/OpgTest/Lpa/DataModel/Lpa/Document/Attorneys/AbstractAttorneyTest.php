<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document\Attorneys;

use Opg\Lpa\DataModel\Lpa\Document\Attorneys\AbstractAttorney;
use Opg\Lpa\DataModel\Lpa\Document\Attorneys\Human;
use Opg\Lpa\DataModel\Lpa\Document\Attorneys\TrustCorporation;
use OpgTest\Lpa\DataModel\FixturesData;

class AbstractAttorneyTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryNotJson()
    {
        $data = 'Not JSON';

        $this->setExpectedException(\InvalidArgumentException::class, 'Invalid JSON passed to constructor');

        AbstractAttorney::factory($data);
    }

    public function testFactoryHuman()
    {
        $data = FixturesData::getAttorneyHumanJson();

        $attorney = AbstractAttorney::factory($data);

        $this->assertEquals(Human::class, get_class($attorney));
    }

    public function testFactoryTrust()
    {
        $data = FixturesData::getAttorneyTrustJson();

        $attorney = AbstractAttorney::factory($data);

        $this->assertEquals(TrustCorporation::class, get_class($attorney));
    }
}