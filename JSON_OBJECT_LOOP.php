<?php
$someJSON = '[
  {
    "name": "Jonathan Suh",
    "gender": "male"
  },
  {
    "name": "William Philbin",
    "gender": "male"
  },
  {
    "name": "Allison McKinnery",
    "gender": "female"
  },
  {
    "name": "Kalin Georgiev",
    "gender": "male"
  }
]';

$someObject = json_decode($someJSON);

for($i=0; $i <= count($someObject); $i++) {
  echo $someObject[$i]->name . '<br>';
}