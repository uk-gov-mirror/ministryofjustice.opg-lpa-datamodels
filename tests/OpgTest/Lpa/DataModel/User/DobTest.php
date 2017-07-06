<?php

namespace OpgTest\Lpa\DataModel\User;

use Opg\Lpa\DataModel\User\Dob;
use OpgTest\Lpa\DataModel\FixturesData;
use OpgTest\Lpa\DataModel\TestHelper;

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
        TestHelper::assertNoDuplicateErrorMessages($errors, $this);
        $this->assertNotNull($errors['date']);
        $this->assertEquals('cannot-be-blank', $errors['date']['messages'][0]);
    }

    public function testValidationFailedInFuture()
    {
        $dob = new Dob();
        $dob->set('date', new \DateTime('2199-01-01'));

        $validatorResponse = $dob->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        TestHelper::assertNoDuplicateErrorMessages($errors, $this);
        $this->assertNotNull($errors['date']);
        $this->assertEquals('must-be-less-than-or-equal:Jul 6, 2017 12:00 AM', $errors['date']['messages'][0]);
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