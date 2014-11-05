<?php
namespace Opg\Lpa\DataModel\Lpa;

use Exception;
use InvalidArgumentException;

use Opg\Lpa\DataModel\Lpa\Document\Document;

use Respect\Validation\Validator;

class Lpa extends AbstractData {

    /**
     * @var int The LPA identifier.
     */
    protected $id = 1234;

    /**
     * @var DateTime the LPA was created.
     */
    protected $createdAt;

    /**
     * @var DateTime the LPA was last updated.
     */
    protected $updatedAt;

    /**
     * @var string LPS's owner User identifier.
     */
    protected $user = 'ad353da6b73ceee2201cee2f9936c509';

    /**
     * @var Payment status.
     */
    protected $payment;

    /**
     * @var bool Flag to record whether the 'Who Are You' question has been answered with regards to this LPA.
     */
    protected $whoAreYouAnswered;

    /**
     * @var bool Is this LPA locked. i.e. read-only.
     */
    protected $locked;

    /**
     * @var int Reference to another LPA on which this LPA is based.
     */
    protected $seed;

    /**
     * @var Document All the details making up the LPA document.
     */
    protected $document;

    //------------------------------------------------

    public function __construct(){

        $this->createdAt = new \DateTime();
        //$this->updatedAt = new \DateTime();

        $this->document = new Document();

        //---

        $this->validators['id'] = function(){
            return Validator::int()->between(0, 99999999999);
        };

        $this->validators['user'] = function(){
            return Validator::xdigit()->length(32,32);
        };

        $this->validators['createdAt'] = function(){
            return Validator::instance('DateTime')->call( function($input){
                return ( $input instanceof \DateTime ) ? $input->gettimezone()->getName() : null;
            }, Validator::equals('UTC') );
        };

        $this->validators['updatedAt'] = function(){
            return Validator::instance('DateTime')->call( function($input){
                return ( $input instanceof \DateTime ) ? $input->gettimezone()->getName() : null;
            }, Validator::equals('UTC') );
        };

        $this->validators['document'] = function(){
            return Validator::instance('Opg\Lpa\DataModel\Lpa\Document\Document')->addOr( Validator::nullValue() );
        };

    } // function

} // class
