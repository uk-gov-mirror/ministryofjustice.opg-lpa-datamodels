<?php

date_default_timezone_set('UTC');


require_once 'vendor/autoload.php';

use Respect\Validation\Validator;


$lpa = new Opg\Lpa\DataModel\Lpa\Lpa();

//$lpa = new SimplyEntity( 'id', Validator::alnum()->noWhitespace()->length(1,15), 'A00000000000' );

//------------------------------
// Interface I'd like...

$lpa->id = 1234654645;


echo "Here\n";


//$v = $lpa->validate( 'updatedAt' );
//$v = $lpa->validate();

//var_dump( $v ); exit();


//$lpa->id = 'test';
//echo $lpa->id."\n";

//var_dump( $lpa->validate() );



//echo $lpa->validate('id')."\n";


