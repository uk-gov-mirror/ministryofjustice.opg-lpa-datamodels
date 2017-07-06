<?php

namespace OpgTest\Lpa\DataModel\Lpa\Elements;

use Opg\Lpa\DataModel\Lpa\Elements\PhoneNumber;

class PhoneNumberTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $phone = new PhoneNumber();
        $phone->set('number', '02114214153553');

        $validatorResponse = $phone->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $phone = new PhoneNumber();

        $validatorResponse = $phone->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['number']);
        $this->assertEquals(1, count($errors['number']['messages']));
    }
}