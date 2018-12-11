<?php

namespace Opg\Lpa\DataModel\Validator\Constraints;

use Symfony\Component\Validator\Constraints as SymfonyConstraints;

class NotIdenticalTo extends SymfonyConstraints\NotIdenticalTo
{
    use ValidatorPathTrait;

    public $message = 'cannot-be-identical-to:{{ compared_value }}';
}
