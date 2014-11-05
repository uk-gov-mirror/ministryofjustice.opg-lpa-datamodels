<?php
namespace Opg\Lpa\DataModel\Lpa;

use Exception;
use InvalidArgumentException;

use Opg\Lpa\DataModel\Validator\Error as ValidatorError;
use Opg\Lpa\DataModel\Validator\Errors as ValidatorErrors;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions;

abstract class AbstractData {

    protected $validators = array();

    //---

    public function __get( $property ){
        return $this->get( $property );
    }

    public function get( $property ){

        if( !property_exists( $this, $property ) ){
            throw new InvalidArgumentException("$property is not a valid property");
        }

        return $this->{$property};

    } // function

    public function set( $property, $value, $validate = true ){

        if( !property_exists( $this, $property ) ){
            throw new InvalidArgumentException("$property is not a valid property");
        }

    } // function

    public function validate( $property = null ){

        $errors = new ValidatorErrors();

        // CHANGE THIS SO AN ARRAY OF PROPERTIES CAN ALSO BE PASSED.

        // If a property was passed, create an array containing only it.
        // Otherwise include all $properties for which there is a validator.
        $properties = ( isset($property) )? array( $property ) : array_keys($this->validators);

        foreach( $properties as $name ) {

            $value = $this->get( $name );
            $validator = $this->getValidator( $name );

            try {

                $validator->assert( $value );

            } catch( Exceptions\AbstractNestedException $e) {

                $error = new ValidatorError();

                $error->property = $name;
                $error->value = $value;

                foreach( $e->getIterator() as $exception ){
                    $error->messages[] = $exception->getMessage();
                }

                $errors->addError( $error );

            } // catch

        } // foreach

        return $errors;

    } // function

    protected function getValidator( $property ){

        if( !isset($this->validators[$property]) ){
            throw new Exception("No validator for $property found");
        }

        $validator = $this->validators[$property];

        if( is_object($validator) && ($validator instanceof \Closure) ) {
            $validator = $validator();
        }

        if( !($validator instanceof Validatable) ){
            throw new Exception("No validator for $property found");
        }

        return $validator;

    } // function

} // abstract class
