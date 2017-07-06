<?php

namespace OpgTest\Lpa\DataModel\Lpa\Elements;

use Opg\Lpa\DataModel\Lpa\Elements\EmailAddress;
use OpgTest\Lpa\DataModel\FixturesData;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $donor = FixturesData::getDonor();
        $email = $donor->get('email');

        $validatorResponse = $email->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $email = new EmailAddress();

        $validatorResponse = $email->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['address']);
        $this->assertEquals(1, count($errors['address']['messages']));
    }

    public function testToString()
    {
        $donor = FixturesData::getDonor();
        $email = $donor->get('email');

        $this->assertEquals('92zx2n1nk@wx.co.uk', '' . $email);
    }
}