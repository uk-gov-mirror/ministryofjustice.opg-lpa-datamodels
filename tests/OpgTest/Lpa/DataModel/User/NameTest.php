<?php

namespace OpgTest\Lpa\DataModel\User;

use Opg\Lpa\DataModel\User\Name;
use OpgTest\Lpa\DataModel\FixturesData;

class NameTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $user = FixturesData::getUser();
        $name = $user->get('name');

        $validatorResponse = $name->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $name = new Name();
        $name->set('title', FixturesData::generateRandomString(6));
        $name->set('first', FixturesData::generateRandomString(51));
        $name->set('last', FixturesData::generateRandomString(51));

        $validatorResponse = $name->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(3, count($errors));
        $this->assertNotNull($errors['title']);
        $this->assertEquals(1, count($errors['title']['messages']));
        $this->assertNotNull($errors['first']);
        $this->assertEquals(1, count($errors['first']['messages']));
        $this->assertNotNull($errors['last']);
        $this->assertEquals(1, count($errors['last']['messages']));
    }

    public function testToString()
    {
        $user = FixturesData::getUser();
        $name = $user->get('name');

        $this->assertEquals('Mr Chris Smith', '' . $name);
    }
}