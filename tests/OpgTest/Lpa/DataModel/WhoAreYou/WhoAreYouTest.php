<?php

namespace OpgTest\Lpa\DataModel\WhoAreYou;

use Opg\Lpa\DataModel\WhoAreYou\WhoAreYou;

class WhoAreYouTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationFailed()
    {
        $whoAreYou = new WhoAreYou();

        $validatorResponse = $whoAreYou->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['who']);
    }

    public function testValidationFailedWhoSet()
    {
        $whoAreYou = new WhoAreYou();
        $whoAreYou->set('who', 'Test');

        $validatorResponse = $whoAreYou->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['who']);
    }

    public function testValidationFailedIncorrectChoice()
    {
        $whoAreYou = new WhoAreYou();
        $whoAreYou->set('who', 'donor');
        $whoAreYou->set('subquestion', 'Incorrect');
        $whoAreYou->set('qualifier', true);

        $validatorResponse = $whoAreYou->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(2, count($errors));
        $this->assertNotNull($errors['subquestion']);
        $this->assertNotNull($errors['qualifier']);
    }
}