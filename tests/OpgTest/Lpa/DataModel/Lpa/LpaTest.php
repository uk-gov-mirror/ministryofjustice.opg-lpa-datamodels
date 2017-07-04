<?php

namespace OpgTest\Lpa\DataModel\Lpa;

use OpgTest\Lpa\DataModel\FixturesData;

class LpaTest extends \PHPUnit_Framework_TestCase
{
    public function testLpaIsEqual()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        //Reference should be different
        $this->assertFalse($lpa === $comparisonLpa);
        //But the object should be structurally the same
        /** @noinspection PhpNonStrictObjectEqualityInspection */
        $this->assertTrue($lpa == $comparisonLpa);
        $this->assertEquals($lpa, $comparisonLpa);
        $this->assertTrue($lpa->equals($comparisonLpa));
    }

    public function testLpaIsNotEqual()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        $comparisonLpa->get('document')->donor->name->first = "Edited";

        //Verify edits have been applied
        $this->assertEquals("Ayden", $lpa->get('document')->donor->name->first);
        $this->assertEquals("Edited", $comparisonLpa->get('document')->donor->name->first);

        /** @noinspection PhpNonStrictObjectEqualityInspection */
        $this->assertFalse($lpa == $comparisonLpa);
        $this->assertNotEquals($lpa, $comparisonLpa);
        $this->assertFalse($lpa->equals($comparisonLpa));
    }

    public function testLpaIsNotEqualMetadata()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        $comparisonLpa->get('metadata')['analyticsReturnCount']++;

        //Verify edits have been applied
        $this->assertEquals(4, $lpa->get('metadata')['analyticsReturnCount']);
        $this->assertEquals(5, $comparisonLpa->get('metadata')['analyticsReturnCount']);

        /** @noinspection PhpNonStrictObjectEqualityInspection */
        $this->assertFalse($lpa == $comparisonLpa);
        $this->assertNotEquals($lpa, $comparisonLpa);
        $this->assertFalse($lpa->equals($comparisonLpa));
    }

    public function testLpaIsEqualIgnoringMetadata()
    {
        $lpa = FixturesData::getPfLpa();
        $comparisonLpa = FixturesData::getPfLpa();

        $comparisonLpa->get('metadata')['analyticsReturnCount']++;

        $this->assertTrue($lpa->get('document') == $comparisonLpa->get('document'));
        $this->assertEquals($lpa->get('document'), $comparisonLpa->get('document'));
        $this->assertTrue($lpa->equalsIgnoreMetadata($comparisonLpa));
    }
}