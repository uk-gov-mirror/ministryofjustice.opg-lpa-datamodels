<?php

namespace OpgTest\Lpa\DataModel\Common;

use Opg\Lpa\DataModel\Common\Dob;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class DobTest extends \PHPUnit_Framework_TestCase
{
    public function testNonDatePropertyDoesNotMap()
    {
        $dob = new TestableDob();
        $mapped = $dob->testMap('notDate', 'date');

        $this->assertEquals('date', $mapped);
    }

    public function testNumberDoesNotMap()
    {
        $dob = new TestableDob();
        $mapped = $dob->testDateMap(23);

        $this->assertEquals('0', $mapped);
    }

    public function testDateIsReturned()
    {
        $dob = new TestableDob();
        $v = new \DateTime();
        $mapped = $dob->testDateMap($v);

        $this->assertEquals($v, $mapped);
        $this->assertTrue($v === $mapped);
    }

    public function testDayAndMonthDoesNotMap()
    {
        $dob = new TestableDob();
        $mapped = $dob->testDateMap('01-02');

        $this->assertEquals('0', $mapped);
    }

    public function testDateMap()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('26-10-1985 00:00:00');
        $mapped = $dob->testDateMap('1985-10-26');

        $this->assertEquals($expected, $mapped);
    }

    public function testDateMapNoZeros()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('01-02-1985 00:00:00');
        $mapped = $dob->testDateMap('1985-2-1');

        $this->assertEquals($expected, $mapped);
    }

    public function testDateTimeMap()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('26-10-1985 01:21:34');
        $mapped = $dob->testDateMap('1985-10-26T01:21:34.000000+0000');

        $this->assertEquals($expected, $mapped);
    }

    public function testDateTimeMapZeroTime()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('01-12-1982 00:00:00');
        $mapped = $dob->testDateMap('1982-12-01T00:00:00.000000+0000');

        $this->assertEquals($expected, $mapped);
    }

    public function testDateMapLeadingZeros()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('26-10-1985 00:00:00');
        $mapped = $dob->testDateMap('01985-010-026');

        $this->assertEquals($expected, $mapped);
    }

    public function testDateMapLeadingZerosNoZeros()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('01-02-1985 00:00:00');
        $mapped = $dob->testDateMap('01985-002-001');

        $this->assertEquals($expected, $mapped);
    }

    public function testMetadataMessageSpecified()
    {
        $metadata = new ClassMetadata(get_class(new Dob()));
        TestableDob::loadValidatorMetadata($metadata, 'Error message');
        $dateMetadata = $metadata->getPropertyMetadata('date');
        $this->assertEquals('Error message', $dateMetadata[0]->constraints[2]->message);
    }

    public function testMetadataMessageNotSpecified()
    {
        $metadata = new ClassMetadata(Dob::class);
        TestableDob::loadValidatorMetadata($metadata);
        $dateMetadata = $metadata->getPropertyMetadata('date');
        $this->assertEquals('must-be-less-than-or-equal:{{ compared_value }}', $dateMetadata[0]->constraints[2]->message);
    }

    public function testMapIso8601()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('07-10-1948 00:00:00');
        $mapped = $dob->testDateMap('1948-10-07T00:00:00.000Z');

        $this->assertEquals($expected, $mapped);
    }

    public function testMapMalformedIso8601()
    {
        $dob = new TestableDob();
        $expected = new \DateTime('07-10-1948 00:00:00');
        $mapped = $dob->testDateMap('1948-10-07T00:00:00.000');

        $this->assertEquals($expected, $mapped);
    }

    public function testStringDateDoesNotMap()
    {
        $dob = new TestableDob();
        $mapped = $dob->testDateMap('1st-Feb-1997');

        $this->assertEquals('0', $mapped);
    }
}

class TestableDob extends Dob
{
    public static function loadValidatorMetadata(ClassMetadata $metadata, $message = null)
    {
        parent::loadValidatorMetadataCommon($metadata, $message);
    }

    public function testMap($property, $v)
    {
        return parent::map($property, $v);
    }

    public function testDateMap($v)
    {
        return self::testMap('date', $v);
    }
}