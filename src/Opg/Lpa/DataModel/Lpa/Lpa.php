<?php
namespace Opg\Lpa\DataModel\Lpa;

use Opg\Lpa\DataModel\Lpa\Document\Document;

use Respect\Validation\Rules;
use Opg\Lpa\DataModel\Validator\Validator; // Extended instance of Respect\Validation\Validator

class Lpa extends AbstractData implements CompleteInterface {

    /**
     * @var int The LPA identifier.
     */
    protected $id = 'abc5';

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

        $this->validators['id'] = function(){
            return (new Validator)->addRules([
                (new Rules\Int),
                (new Rules\Between( 0, 99999999999, true )),
            ]);
        };

        $this->validators['user'] = function(){
            return (new Validator)->addRules([
                (new Rules\Xdigit),
                (new Rules\Length( 32, 32, true ))->setTemplate('not-in-range/32-32'),
            ])->setTemplate('invalid-group');
        };

        $this->validators['createdAt'] = function(){
            return (new Validator)->addRules([
                (new Rules\Instance( 'DateTime' ))->setTemplate('not-datetime'),
                (new Rules\Call(function($input){
                    return ( $input instanceof \DateTime ) ? $input->gettimezone()->getName() : 'UTC';
                }))->setTemplate('not-utc'),
            ])->setTemplate('invalid-group');
        };

    } // function

    //--------------------------------------------------------------------

    /**
     * Check whether the LPA document is complete and valid at the business level.
     *
     * @return bool
     */
    public function isComplete(){

        return false;

    } // function

} // class
