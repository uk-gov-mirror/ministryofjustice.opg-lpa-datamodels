<?php

namespace OpgTest\Lpa\DataModel\User;

use Opg\Lpa\DataModel\User\Dob;
use OpgTest\Lpa\DataModel\FixturesData;

class DobTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $user = FixturesData::getUser();
        $dob = $user->get('dob');

        $validatorResponse = $dob->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $dob = new Dob();

        $validatorResponse = $dob->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['date']);
    }

    public function testValidationFailedOnlyOneMessage()
    {
        $dob = new Dob();

        $validatorResponse = $dob->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors['date']['messages']));
    }

    public function testValidationFailedInFuture()
    {
        $dob = new Dob();
        $dob->set('date', new \DateTime('2199-01-01'));

        $validatorResponse = $dob->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['date']);
    }

    public function testStringDateDoesNotMap()
    {
        $dob = new TestableDob();

        $this->setExpectedException(\RuntimeException::class, 'Invalid date: 1st-Feb-1997. Date must exist and be in ISO-8601 format.');

        $dob->testDateMap('1st-Feb-1997');
    }
}

class TestableDob extends Dob
{
    public function testDateMap($v)
    {
        return self::map('date', $v);
    }
}