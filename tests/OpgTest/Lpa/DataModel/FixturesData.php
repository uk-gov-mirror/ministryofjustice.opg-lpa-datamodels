<?php

namespace OpgTest\Lpa\DataModel;

use Opg\Lpa\DataModel\Lpa\Document\Attorneys\AbstractAttorney;
use Opg\Lpa\DataModel\Lpa\Document\Attorneys\Human;
use Opg\Lpa\DataModel\Lpa\Lpa;
use Opg\Lpa\DataModel\User\User;

/**
 * Class FixturesData returns complex test data
 * @package OpgTest\Lpa\DataModel
 */
class FixturesData
{
    private static $fixturesPath = __DIR__ . '/../../../fixtures/';

    public static function getHwLpaJson()
    {
        return file_get_contents(self::$fixturesPath . 'hw.json');
    }

    public static function getPfLpaJson()
    {
        return file_get_contents(self::$fixturesPath . 'pf.json');
    }

    /**
     * Returns a complete Heath and Welfare LPA
     *
     * @return Lpa
     */
    public static function getHwLpa()
    {
        return new Lpa(self::getHwLpaJson());
    }

    /**
     * Returns a complete Property and Finance LPA
     *
     * @return Lpa
     */
    public static function getPfLpa()
    {
        return new Lpa(self::getPfLpaJson());
    }

    /*
     * Returns valid JSON for a Human Attorney
     */
    public static function getAttorneyHumanJson($removeType = false)
    {
        $json = file_get_contents(self::$fixturesPath . 'attorney-human.json');
        if ($removeType) {
            $json = str_replace('"type": "human"', '"type": ""', $json);
        }
        return $json;
    }

    /*
     * Returns valid JSON for a Trust Attorney
     */
    public static function getAttorneyTrustJson($removeType = false)
    {
        $json = file_get_contents(self::$fixturesPath . 'attorney-trust.json');
        if ($removeType) {
            $json = str_replace('"type": "trust"', '"type": ""', $json);
        }
        return $json;
    }

    /**
     * @return Human|\Opg\Lpa\DataModel\Lpa\Document\Attorneys\TrustCorporation
     */
    public static function getAttorneyHuman($id = 3)
    {
        $human = AbstractAttorney::factory(self::getAttorneyHumanJson());
        $human->set('id', $id);
        return $human;
    }

    /**
     * @return Human|\Opg\Lpa\DataModel\Lpa\Document\Attorneys\TrustCorporation
     */
    public static function getAttorneyTrust($id = 4)
    {
        $trustCorporation = AbstractAttorney::factory(self::getAttorneyTrustJson());
        $trustCorporation->set('id', $id);
        return $trustCorporation;
    }

    /**
     * @return \Opg\Lpa\DataModel\Lpa\Document\Donor
     */
    public static function getDonor()
    {
        $lpa = self::getHwLpa();
        return $lpa->get('document')->donor;
    }

    /**
     * @return \Opg\Lpa\DataModel\Lpa\Document\CertificateProvider
     */
    public static function getCertificateProvider()
    {
        $lpa = self::getHwLpa();
        return $lpa->get('document')->certificateProvider;
    }

    /**
     * @return \Opg\Lpa\DataModel\Lpa\Document\Correspondence
     */
    public static function getCorrespondence()
    {
        $lpa = self::getPfLpa();
        return $lpa->get('document')->correspondent;
    }

    /**
     * @return \Opg\Lpa\DataModel\Lpa\Document\Decisions\PrimaryAttorneyDecisions
     */
    public static function getPrimaryAttorneyDecisions()
    {
        $lpa = self::getHwLpa();
        return $lpa->get('document')->primaryAttorneyDecisions;
    }

    /**
     * @return \Opg\Lpa\DataModel\Lpa\Document\Decisions\ReplacementAttorneyDecisions
     */
    public static function getReplacementAttorneyDecisions()
    {
        $lpa = self::getPfLpa();
        return $lpa->get('document')->replacementAttorneyDecisions;
    }

    /**
     * @return \Opg\Lpa\DataModel\Lpa\Document\NotifiedPerson
     */
    public static function getNotifiedPerson()
    {
        $lpa = self::getHwLpa();
        return $lpa->get('document')->peopleToNotify[0];
    }

    public static function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getUserJson()
    {
        return file_get_contents(self::$fixturesPath . 'user.json');
    }

    public static function getUser()
    {
        return new User(self::getUserJson());
    }
}