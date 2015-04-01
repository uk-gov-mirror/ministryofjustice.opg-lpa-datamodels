<?php
namespace Opg\Lpa\DataModel\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\CountValidator as SymfonyCountValidator;

/**
 * Count validator that validates boolean false as null.
 *
 * Class CountValidator
 * @package Opg\Lpa\DataModel\Validator\Constraints
 */
class CountValidator extends SymfonyCountValidator {

    public function validate($value, Constraint $constraint){

        if( $value === false ){
            $value = null;
        }

        parent::validate( $value, $constraint );

    } // function

} // class
