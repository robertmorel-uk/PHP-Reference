<?php

// Store 3 anonymous functions in an array
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