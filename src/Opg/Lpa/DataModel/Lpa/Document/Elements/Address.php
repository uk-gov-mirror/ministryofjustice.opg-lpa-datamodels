<?php
namespace Opg\Lpa\DataModel\Lpa\Document\Elements;

use Opg\Lpa\DataModel\Lpa\AbstractData;

class Address extends AbstractData {

    protected $address1;
    protected $address2;
    protected $address3;
    protected $postcode;

    public function __construct(){

        # TEMPORARY TEST DATA ------------

        $this->address1 = 'Line 1';
        $this->address2 = 'Line 2';
        $this->address3 = 'Line 3';
        $this->postcode = 'Postcode';

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

    } // function

} // trait
