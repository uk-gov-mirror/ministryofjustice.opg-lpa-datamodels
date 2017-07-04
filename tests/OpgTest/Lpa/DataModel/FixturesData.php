<?php

namespace OpgTest\Lpa\DataModel;

use Opg\Lpa\DataModel\Lpa\Lpa;

/**
 * Class FixturesData returns complex test data
 * @package OpgTest\Lpa\DataModel
 */
class FixturesData
{
    private static $fixturesPath = __DIR__ . '/../../../fixtures/';

    /**
     * Returns a complete Heath and Welfare LPA
     *
     * @return Lpa
     */
    public static function getHwLpa()
    {
        return new Lpa(file_get_contents(self::$fixturesPath . 'hw.json'));
    }

    /**
     * Returns a complete Property and Finance LPA
     *
     * @return Lpa
     */
    public static function getPfLpa()
    {
        return new Lpa(file_get_contents(self::$fixturesPath . 'pf.json'));
    }

    /*
     * Returns valid JSON for a Human Attorney
     */
    public static function getAttorneyHumanJson()
    {
        return file_get_contents(self::$fixturesPath . 'attorney-human.json');
    }
    /*
     * Returns valid JSON for a Trust Attorney
     */
    public static function getAttorneyTrustJson()
    {
        return file_get_contents(self::$fixturesPath . 'attorney-trust.json');
    }
}