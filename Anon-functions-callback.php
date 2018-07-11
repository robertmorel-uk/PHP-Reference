<?php

//---------------- Assign an anonymous function to a variable

$makeGreeting = function( $name, $timeOfDay ) {
  return ( "Good $timeOfDay, $name!" );
};

// Call the anonymous function
echo $makeGreeting( "Rob", "morning" );

//----------------- Store 3 anonymous functions in an array

$luckyDip = array(
 
  function() {
    echo "You got a bag of toffees!";
  },
 
  function() {
    echo "You got a toy car!";
  },
 
  function() {
    echo "You got some balloons!";
  }
);

// Call a random function
$choice = rand( 0, 2 );
$luckyDip[$choice]();

//---------------- Using anonymous functions as callbacks

// Create a regular callback function...
// Function will be called on every element of array
function nameToGreeting( $name ) {
  return "Hello " . ucfirst( $name ) . "!";
}
 
// map the callback function to elements in an array.
$names = array( "Rob", "Frannie", "Rose" );
print_r( array_map( nameToGreeting, $names ) );

//outputs:
Array ( [0] => Hello Fred! [1] => Hello Mary! [2] => Hello Sally! )

//---------------- Refactored as anonymous function
// Map an anonymous callback function to elements in an array.
print_r ( array_map( function( $name ) {
  return "Hello " . ucfirst( $name ) . "!";
}, $names ) );