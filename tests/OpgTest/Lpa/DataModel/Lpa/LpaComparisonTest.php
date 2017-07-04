<?php

namespace OpgTest\Lpa\DataModel\Lpa;

use OpgTest\Lpa\DataModel\FixturesData;

class ComparisonTest extends \PHPUnit_Framework_TestCase
{
    public function testLpaIsEqual()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        //Reference should be different
        $this->assertFalse($lpa === $comparisonLpa);
        //But the object should be structurally the same
        $this->assertTrue($lpa == $comparisonLpa);
        $this->assertEquals($lpa, $comparisonLpa);
        $this->assertTrue($lpa->equals($comparisonLpa));
    }

    public function testLpaIsNotEqual()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        $comparisonLpa->document->donor->name->first = "Edited";

        //Verify edits have been applied
        $this->assertEquals("Ayden", $lpa->document->donor->name->first);
        $this->assertEquals("Edited", $comparisonLpa->document->donor->name->first);

        $this->assertFalse($lpa == $comparisonLpa);
        $this->assertNotEquals($lpa, $comparisonLpa);
        $this->assertFalse($lpa->equals($comparisonLpa));
    }

    public function testLpaIsNotEqualMetadata()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        $comparisonLpa->metadata['analyticsReturnCount']++;

        //Verify edits have been applied
        $this->assertEquals(4, $lpa->metadata['analyticsReturnCount']);
        $this->assertEquals(5, $comparisonLpa->metadata['analyticsReturnCount']);

        $this->assertFalse($lpa == $comparisonLpa);
        $this->assertNotEquals($lpa, $comparisonLpa);
        $this->assertFalse($lpa->equals($comparisonLpa));
    }

    public function testLpaIsEqualIgnoringMetadata()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        $comparisonLpa->metadata['analyticsReturnCount']++;

        $this->assertTrue($lpa->document == $comparisonLpa->document);
        $this->assertEquals($lpa->document, $comparisonLpa->document);
        $this->assertTrue($lpa->equalsIgnoreMetadata($comparisonLpa));
    }
}
