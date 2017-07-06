<?php

namespace OpgTest\Lpa\DataModel\Common;

use Opg\Lpa\DataModel\Common\Dob;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class TestableDob extends Dob
{
    public static function loadValidatorMetadata(ClassMetadata $metadata = null, $message = null)
    {
        if ($metadata === null) {
            $metadata = new ClassMetadata(Dob::class);
        }
        parent::loadValidatorMetadataCommon($metadata, $message);
    }

    public function testMap($property, $v)
    {
        return parent::map($property, $v);
    }

    public function testDateMap($v)
    {
        return self::testMap('date', $v);
    }
}
