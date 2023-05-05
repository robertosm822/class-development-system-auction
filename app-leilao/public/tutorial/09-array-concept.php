<?php
/*

    In the tutorial, we are going to talk about the Array structure in PHP.

    Array processing is one area where PHP shines above other
    languages. In addition to  the many built-in functions to
    assist in processing arrays, PHP understands the following
    operators when applied to arrays:
    - + Union;
    - == Equal by value;
    - === Identical, or equal by value and type;
    - != Not equal by value;
    - <> Not equal;
    - !== Not identical by value or type;
*/
//Example union operator
$arrayOne = ['a' => 'Apples', 'b' => 'Oranges', 'c' => 'Peaches'];
$arrayTwo = ['c' => 'Pears', 'd' => 'Bananas'];

//print_r($arrayOne + $arrayTwo);
//print_r($arrayTwo + $arrayOne);




/*
    Note the result is dependent on which array is added to which.
    The two print_r()  statements in the prior code example output the same results.
    The right-hand array  is appended to the left-hand array.  If a matching associative
    key exists in both arrays, and the operation is as shown in  the above addition
    operation print_r() statements, the left most parameter array’s  associative key
    will prevail. This only happens with matching associative keys.

    Numeric keys are indexed and appended.  The array equality and in-equality operators
    operate exactly expected. They  compare arrays and values, and return the appropriate
    response.

    Note that equals is not the sama as identical.
*/
// For example comparison:
$arrayOne = ['apple', 'banana'];
$arrayTwo = [1 => 'banana', '0' => 'apple'];
//var_dump($arrayOne == $arrayTwo); //??
//var_dump($arrayOne === $arrayTwo); //??




/*
    In $arrayTwo, the assigned elements appear in a different order;
    internally, PHP  stores them different. Even though both
    echo $arrayOne[1]; and echo $arrayTwo[1];  would output banana,
    the arrays are not identical.

    Arrays that contain objects are another interesting thing to note.
    Given two arrays  that each hold an instance of a Person object,
    containing the same data, they are not  identical. The objects
    themselves occupy different memory space and thus are not
    considered identical, even if their contents are the same.
*/
//Look at the example:
$objectOne = new stdClass();
$objectTwo = clone $objectOne;

$arrayOne = [$objectOne];
$arrayTwo = [$objectTwo];

//var_dump($arrayOne == $arrayTwo);
//var_dump($arrayOne === $arrayTwo);



//pause page = 23
