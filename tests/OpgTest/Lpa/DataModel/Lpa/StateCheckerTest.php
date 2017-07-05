<?php

namespace OpgTest\Lpa\DataModel\Lpa;

use Opg\Lpa\DataModel\Lpa\StateChecker;
use OpgTest\Lpa\DataModel\FixturesData;

class StateCheckerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $lpa = FixturesData::getHwLpa();
        $stateChecker = new StateChecker($lpa);
        $this->assertTrue($lpa === $stateChecker->getLpa());
    }

    public function testConstructorNoLpa()
    {
        $stateChecker = new StateChecker(null);
        $this->setExpectedException(\InvalidArgumentException::class, 'No LPA has been set');
        $stateChecker->getLpa();
    }
}