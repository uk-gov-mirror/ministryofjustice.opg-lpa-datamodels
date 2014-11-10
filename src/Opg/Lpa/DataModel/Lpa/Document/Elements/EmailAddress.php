<?php
namespace Opg\Lpa\DataModel\Lpa\Document\Elements;

use Opg\Lpa\DataModel\Lpa\AbstractData;

class EmailAddress extends AbstractData {

    protected $email;

    public function __construct(){

        # TEMPORARY TEST DATA ------------

        $this->email = 'test@digital.justice.gov.uk';

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

    } // function

} // trait
