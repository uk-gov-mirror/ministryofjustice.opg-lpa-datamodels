<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document;

use Opg\Lpa\DataModel\Lpa\Document\Document;
use Opg\Lpa\DataModel\Lpa\Document\NotifiedPerson;
use OpgTest\Lpa\DataModel\FixturesData;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class DocumentTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadValidatorMetadata()
    {
        $metadata = new ClassMetadata(Document::class);

        Document::loadValidatorMetadata($metadata);

        $this->assertEquals(12, count($metadata->properties));
        $this->assertNotNull($metadata->properties['id']);
        $this->assertNotNull($metadata->properties['name']);
        $this->assertNotNull($metadata->properties['address']);
    }

    public function testMap()
    {
        $document = FixturesData::getHwLpa()->get('document');

        $this->assertEquals(1, $document->get('id'));

        $this->assertEquals('Miss', $document->get('name')->title);
        $this->assertEquals('Elizabeth', $document->get('name')->first);
        $this->assertEquals('Stout', $document->get('name')->last);

        $this->assertEquals('747 Station Road', $document->get('address')->address1);
        $this->assertEquals('Clayton le Moors', $document->get('address')->address2);
        $this->assertEquals('Lancashire, England', $document->get('address')->address3);
        $this->assertEquals('WN8A 8AQ', $document->get('address')->postcode);
    }

    public function testValidation()
    {
        $document = FixturesData::getPfLpa()->get('document');

        $validatorResponse = $document->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $document = new Document();

        $validatorResponse = $document->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(2, count($errors));
        $this->assertNotNull($errors['name']);
        $this->assertNotNull($errors['address']);
    }

    public function testGetPrimaryAttorneyById()
    {
        $document = FixturesData::getHwLpa()->get('document');

        $attorney = $document->getPrimaryAttorneyById(2);

        $this->assertNotNull($attorney);
    }

    public function testGetReplacementAttorneyById()
    {
        $document = FixturesData::getPfLpa()->get('document');

        $attorney = $document->getReplacementAttorneyById(3);

        $this->assertNotNull($attorney);
    }
}