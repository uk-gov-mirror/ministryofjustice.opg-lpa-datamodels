LPA Data Model Validation
===========

This document contains an explanation of LPA (in)validation responses.

Not Blank/Null
---------------
If a value cannot be blank/null, you'll receive the response:

- For Null: ``cannot-be-null``
- For Blank: ``cannot-be-blank``

Type Validation
---------------
If a supplied value is the incorrect type, you'll receive the response:

`incorrect-type|{type}`

where ``{type}`` is the expected data type or class. For example:

- ``incorrect-type|int``
- ``incorrect-type|xdigit`` (i.e. must be a hax value)
- ``incorrect-type|\Opg\Lpa\DataModel\Lpa\Payment\Payment``

Invalid value size (range or length)
--------------------------------------
If a supplied value is the too big or small, you'll receive the response:

- For too small: ``must-be-greater-than-or-equal|{value}``
- For too big: ``must-be-less-than-or-equal|{value}``

if a string much be exactly _N_ characters long, an invalid value will result in:

`length-must-equal|{N}`


DateTime
---------
All dates and times should be stored as a ``DateTime`` object with a UTC time zone. If they're not, you'll receive the response:

``timezone-not-utc`` or ``incorrect-type|DateTime``
