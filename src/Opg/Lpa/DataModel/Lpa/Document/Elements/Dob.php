<?php
namespace Opg\Lpa\DataModel\Lpa\Document\Elements;

use Opg\Lpa\DataModel\Lpa\AbstractData;

class Dob extends AbstractData {

    protected $date;

    public function __construct(){

        # TEMPORARY TEST DATA ------------

        $this->date = new \DateTime( '1980-12-17' );

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

    } // function

} // trait
