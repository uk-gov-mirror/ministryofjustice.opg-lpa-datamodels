<?php

namespace OpgTest\Lpa\DataModel\User;

use Opg\Lpa\DataModel\User\Address;
use OpgTest\Lpa\DataModel\FixturesData;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $user = FixturesData::getUser();
        $address = $user->get('address');

        $this->assertEquals('12 Highway Close, PL45 9JA', '' . $address);
    }

    public function testValidation()
    {
        $user = FixturesData::getUser();
        $address = $user->get('address');

        $validatorResponse = $address->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $address = new Address();
        $address->set('address1', FixturesData::generateRandomString(51));
        $address->set('address2', FixturesData::generateRandomString(51));
        $address->set('address3', FixturesData::generateRandomString(51));
        $address->set('postcode', FixturesData::generateRandomString(9));

        $validatorResponse = $address->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(4, count($errors));
        $this->assertNotNull($errors['address1']);
        $this->assertEquals(1, count($errors['address1']['messages']));
        $this->assertNotNull($errors['address2']);
        $this->assertEquals(1, count($errors['address2']['messages']));
        $this->assertNotNull($errors['address3']);
        $this->assertEquals(1, count($errors['address3']['messages']));
        $this->assertNotNull($errors['postcode']);
        $this->assertEquals(1, count($errors['postcode']['messages']));
    }
}