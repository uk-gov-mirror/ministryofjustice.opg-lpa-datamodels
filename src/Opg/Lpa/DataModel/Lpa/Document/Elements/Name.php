<?php
namespace Opg\Lpa\DataModel\Lpa\Document\Elements;

use Opg\Lpa\DataModel\Lpa\AbstractData;

class Name extends AbstractData {

    protected $title;
    protected $first;
    protected $last;

    public function __construct(){

        # TEMPORARY TEST DATA ------------

        $this->title = 'Mr';
        $this->first = 'Bob';
        $this->last = 'Sanders';

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

    } // function

} // trait
