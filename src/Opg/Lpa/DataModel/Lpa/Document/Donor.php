<?php
namespace Opg\Lpa\DataModel\Lpa\Document;

use Opg\Lpa\DataModel\Lpa\AbstractData;
use Opg\Lpa\DataModel\Lpa\Document\Elements;

class Donor extends AbstractData {

    protected $name;
    protected $otherNames;
    protected $address;
    protected $dob;
    protected $email;

    public function __construct(){

        $this->name = new Elements\Name();
        $this->otherNames = 'Fred';
        $this->address = new Elements\Address();
        $this->dob = new Elements\Dob();
        $this->email = new Elements\EmailAddress();

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

    }

} // class
