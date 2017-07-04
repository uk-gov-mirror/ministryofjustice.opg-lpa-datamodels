<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document\Attorneys;

use Opg\Lpa\DataModel\Lpa\Document\Attorneys\AbstractAttorney;
use Opg\Lpa\DataModel\Lpa\Document\Attorneys\Human;
use OpgTest\Lpa\DataModel\FixturesData;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class HumanTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadValidatorMetadata()
    {
        $metadata = new ClassMetadata(Human::class);

        Human::loadValidatorMetadata($metadata);

        $this->assertEquals(2, count($metadata->properties));
        $this->assertNotNull($metadata->properties['name']);
        $this->assertNotNull($metadata->properties['dob']);
    }

    public function testMap()
    {
        $data = FixturesData::getAttorneyHumanJson();

        $attorney = AbstractAttorney::factory($data);

        $this->assertEquals('Dr', $attorney->get('name')->title);
        $this->assertEquals('Wellington', $attorney->get('name')->first);
        $this->assertEquals('Gastri', $attorney->get('name')->last);

        $this->assertEquals(new \DateTime('1982-09-02T00:00:00.000000+0000'), $attorney->get('dob')->date);
    }

    public function testToArray()
    {
        $data = FixturesData::getAttorneyHumanJson();

        $attorney = AbstractAttorney::factory($data);
        $attorneyArray = $attorney->toArray();

        $this->assertEquals('human', $attorneyArray['type']);
    }
}