<?php
namespace Opg\Lpa\DataModel\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class DateTimeUTC extends Constraint {

    public $notDateTimeMessage = 'not-datetime';
    public $notUtcMessage = 'timezone-not-utc';

} // class
