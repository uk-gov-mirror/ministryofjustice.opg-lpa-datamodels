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
        $this->assertNotNull($metadata->properties['type']);
        $this->assertNotNull($metadata->properties['donor']);
        $this->assertNotNull($metadata->properties['whoIsRegistering']);
        $this->assertNotNull($metadata->properties['primaryAttorneyDecisions']);
        $this->assertNotNull($metadata->properties['replacementAttorneyDecisions']);
        $this->assertNotNull($metadata->properties['correspondent']);
        $this->assertNotNull($metadata->properties['instruction']);
        $this->assertNotNull($metadata->properties['preference']);
        $this->assertNotNull($metadata->properties['certificateProvider']);
        $this->assertNotNull($metadata->properties['primaryAttorneys']);
        $this->assertNotNull($metadata->properties['replacementAttorneys']);
        $this->assertNotNull($metadata->properties['peopleToNotify']);
    }

    public function testMap()
    {
        $document = FixturesData::getHwLpa()->get('document');

        $this->assertNotNull($document->get('donor'));
        $this->assertNotNull($document->get('primaryAttorneyDecisions'));
        $this->assertNotNull($document->get('replacementAttorneyDecisions'));
        $this->assertNotNull($document->get('correspondent'));
        $this->assertNotNull($document->get('certificateProvider'));
        $this->assertNotNull($document->get('primaryAttorneys'));
        $this->assertNotNull($document->get('replacementAttorneys'));
        $this->assertNotNull($document->get('peopleToNotify'));
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
        $document->set('type', 'incorrect');

        $validatorResponse = $document->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(1, count($errors));
        $this->assertNotNull($errors['type']);
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