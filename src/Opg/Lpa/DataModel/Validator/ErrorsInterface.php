<?php
namespace Opg\Lpa\DataModel\Validator;

interface ErrorsInterface {

    /**
     * Returns bool true iff the object is representing one or more errors.
     *
     * The typical use case of this is to check if a validator passed, or not.
     *
     * @return bool
     */
    public function hasError();

} // interface
