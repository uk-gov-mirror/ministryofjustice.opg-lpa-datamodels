<?php
namespace Opg\Lpa\DataModel\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\AllValidator as SymfonyAllValidator;

/**
 * All validator that validates boolean false as null.
 *
 * Class AllValidator
 * @package Opg\Lpa\DataModel\Validator\Constraints
 */
class AllValidator extends SymfonyAllValidator {

    public function validate($value, Constraint $constraint){

        if( $value === false ){
            $value = null;
        }

        parent::validate( $value, $constraint );

    } // function

} // class
