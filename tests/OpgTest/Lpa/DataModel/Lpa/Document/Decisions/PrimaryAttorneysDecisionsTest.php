<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document\Decisions;

use Opg\Lpa\DataModel\Lpa\Document\Decisions\PrimaryAttorneyDecisions;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class PrimaryAttorneyDecisionsTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadValidatorMetadata()
    {
        $metadata = new ClassMetadata(PrimaryAttorneyDecisions::class);

        PrimaryAttorneyDecisions::loadValidatorMetadata($metadata);

        $this->assertEquals(2, count($metadata->properties));
        $this->assertNotNull($metadata->properties['when']);
        $this->assertNotNull($metadata->properties['canSustainLife']);
        $whenMetadata = $metadata->getPropertyMetadata('when');
        $this->assertEquals([
            PrimaryAttorneyDecisions::LPA_DECISION_WHEN_NOW,
            PrimaryAttorneyDecisions::LPA_DECISION_WHEN_NO_CAPACITY
        ], $whenMetadata[0]->constraints[1]->choices);
    }
}