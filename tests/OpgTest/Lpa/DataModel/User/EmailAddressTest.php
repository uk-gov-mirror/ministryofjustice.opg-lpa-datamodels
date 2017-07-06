<?php

namespace OpgTest\Lpa\DataModel\User;

use Opg\Lpa\DataModel\User\EmailAddress;
use OpgTest\Lpa\DataModel\FixturesData;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $user = FixturesData::getUser();
        $email = $user->get('email');

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
        $user = FixturesData::getUser();
        $email = $user->get('email');

        $this->assertEquals('opgcasper+1498828259628334011473@gmail.com', '' . $email);
    }
}