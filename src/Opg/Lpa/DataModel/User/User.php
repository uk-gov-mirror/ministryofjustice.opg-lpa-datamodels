<?php
namespace Opg\Lpa\DataModel\User;

use DateTime;

use Opg\Lpa\DataModel\AbstractData;
use Respect\Validation\Rules;
use Opg\Lpa\DataModel\Validator\Validator;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use Opg\Lpa\DataModel\Validator\Constraints\DateTimeUTC;

/**
 * Represents a user of the LPA platform.
 *
 * Class User
 */
class User extends AbstractData {

    /**
     * @var string The user's internal ID.
     */
    protected $id;

    /**
     * @var DateTime the user was created.
     */
    protected $createdAt;

    /**
     * @var DateTime the user was last updated.
     */
    protected $updatedAt;

    /**
     * @var Name Their name.
     */
    protected $name;

    /**
     * @var Address Their postal address.
     */
    protected $address;

    /**
     * @var Dob Their date of birth.
     */
    protected $dob;

    /**
     * @var EmailAddress Their email address.
     */
    protected $email;

    //------------------------------------------------

    public static function loadValidatorMetadata(ClassMetadata $metadata){

        $metadata->addPropertyConstraints('id', [
            new Assert\NotBlank,
            new Assert\Type([ 'type' => 'xdigit' ]),
            new Assert\Length([ 'min' => 32, 'max' => 32 ]),
        ]);

        $metadata->addPropertyConstraints('createdAt', [
            new Assert\NotBlank,
            new DateTimeUTC,
        ]);

        $metadata->addPropertyConstraints('updatedAt', [
            new Assert\NotBlank,
            new DateTimeUTC,
        ]);

        $metadata->addPropertyConstraints('name', [
            new Assert\Type([ 'type' => '\Opg\Lpa\DataModel\User\Name' ]),
            new Assert\Valid,
        ]);

        $metadata->addPropertyConstraints('address', [
            new Assert\Type([ 'type' => '\Opg\Lpa\DataModel\User\Address' ]),
            new Assert\Valid,
        ]);

        $metadata->addPropertyConstraints('dob', [
            new Assert\Type([ 'type' => '\Opg\Lpa\DataModel\User\Dob' ]),
            new Assert\Valid,
        ]);

        $metadata->addPropertyConstraints('email', [
            new Assert\Type([ 'type' => '\Opg\Lpa\DataModel\User\EmailAddress' ]),
            new Assert\Valid,
        ]);

    } // function

    public function __construct( $data = null ){

        //-----------------------------------------------------
        // Type mappers

        $this->typeMap['updatedAt'] = $this->typeMap['createdAt'] = function($v){
            return ($v instanceof DateTime) ? $v : new DateTime( $v );
        };

        $this->typeMap['name'] = function($v){
            return ($v instanceof Name || is_null($v)) ? $v : new Name( $v );
        };

        $this->typeMap['address'] = function($v){
            return ($v instanceof Address || is_null($v)) ? $v : new Address( $v );
        };

        $this->typeMap['dob'] = function($v){
            return ($v instanceof Dob || is_null($v)) ? $v : new Dob( $v );
        };

        $this->typeMap['email'] = function($v){
            return ($v instanceof EmailAddress || is_null($v)) ? $v : new EmailAddress( $v );
        };

        //---

        parent::__construct( $data );

    } // function

    //--------------------------------------------------------------------

    /**
     * Returns $this as an array suitable for inserting into MongoDB.
     *
     * @return array
     */
    public function toMongoArray(){
        $data = parent::toMongoArray();

        // Rename 'id' to '_id' (keeping it at the beginning of the array)
        $data = [ '_id'=>$data['id'] ] + $data;

        unset($data['id']);

        return $data;
    }

} // class
