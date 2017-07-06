<?php

namespace OpgTest\Lpa\DataModel\User;

use Opg\Lpa\DataModel\User\User;
use OpgTest\Lpa\DataModel\FixturesData;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testValidation()
    {
        $user = FixturesData::getUser();

        $validatorResponse = $user->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $name = new User();

        $validatorResponse = $name->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(3, count($errors));
        $this->assertNotNull($errors['id']);
        $this->assertEquals(1, count($errors['id']['messages']));
        $this->assertNotNull($errors['createdAt']);
        $this->assertEquals(1, count($errors['createdAt']['messages']));
        $this->assertNotNull($errors['updatedAt']);
        $this->assertEquals(1, count($errors['updatedAt']['messages']));
    }

    public function testToMongoArray()
    {
        $user = FixturesData::getUser();

        $mongoArray = $user->toMongoArray();
        $this->assertEquals($user->get('id'), $mongoArray['_id']);
    }
}