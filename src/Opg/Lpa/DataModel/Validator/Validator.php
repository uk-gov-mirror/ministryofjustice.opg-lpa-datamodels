<?php
namespace Opg\Lpa\DataModel\Validator;

use Respect\Validation\Exceptions;
use Respect\Validation\Exceptions\AbstractGroupedException as EC; // Exception Constants
use Respect\Validation\Validator as RespectValidator;

class Validator extends RespectValidator {

    private static $messagesInitialised = false;

    public function __construct(){

        parent::__construct();

        if( false === self::$messagesInitialised ){
            self::initMessages();
            self::$messagesInitialised = true;
        }

    }

    protected static function initMessages(){

        Exceptions\AllOfException::$defaultTemplates = array(
            Exceptions\AllOfException::MODE_DEFAULT => array(
                Exceptions\AllOfException::NONE => 'all-must-pass',
                Exceptions\AllOfException::SOME => 'all-must-pass',
            ),
            Exceptions\AllOfException::MODE_NEGATIVE => array(
                Exceptions\AllOfException::NONE => 'none-must-pass',
                Exceptions\AllOfException::SOME => 'none-must-pass',
            )
        );

        //-------

        Exceptions\IntException::$defaultTemplates = array(
            Exceptions\IntException::MODE_DEFAULT => array(
                Exceptions\IntException::STANDARD => 'not-int',
            ),
            Exceptions\IntException::MODE_NEGATIVE => array(
                Exceptions\IntException::STANDARD => 'is-int',
            )
        );

        //-------

        Exceptions\LengthException::$defaultTemplates = array(
            Exceptions\LengthException::MODE_DEFAULT => array(
                Exceptions\LengthException::BOTH => 'not-in-range/{{minValue}}-{{maxValue}}',
                Exceptions\LengthException::LOWER => 'not-in-range/{{minValue}}-{{maxValue}}',
                Exceptions\LengthException::GREATER => 'not-in-range/{{minValue}}-{{maxValue}}',
            ),
            Exceptions\LengthException::MODE_NEGATIVE => array(
                Exceptions\LengthException::BOTH => 'is-in-range/{{minValue}}-{{maxValue}}',
                Exceptions\LengthException::LOWER => 'is-in-range/{{minValue}}-{{maxValue}}',
                Exceptions\LengthException::GREATER => 'is-in-range/{{minValue}}-{{maxValue}}',
            )
        );

        //-------

        Exceptions\XdigitException::$defaultTemplates = array(
            Exceptions\XdigitException::MODE_DEFAULT => array(
                Exceptions\XdigitException::STANDARD => 'not-hex',
                Exceptions\XdigitException::EXTRA => 'not-hex-plus-{{additionalChars}}'
            ),
            Exceptions\XdigitException::MODE_NEGATIVE => array(
                Exceptions\XdigitException::STANDARD => 'is-hex',
                Exceptions\XdigitException::EXTRA => 'is-hex-plus-{{additionalChars}}'
            )
        );

        //-------

    } // function

} // class
