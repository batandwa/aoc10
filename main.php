<?php
require_once('vendor/autoload.php');

$climate = new League\CLImate\CLImate();

$climate->arguments->add([
    'length' => [
        'prefix' => 'l',
        'longPrefix' => 'length',
        'description' => 'The length of the hash.',
        'defaultValue' => '256'
    ],
    'inputlist' => [
        'description' => 'Comma delimited sequence of numbers to use as input to the algorithm.',
    ],
]);

$climate->arguments->parse();
// TODO: Test for non-integer values.
$length = (int)$climate->arguments->get('length');
$inputList = $climate->arguments->get('inputlist');

$game = new AOC10\Game($length, $inputList);
$hash = $game->process();

$climate->br()->green()->out(implode('', $hash));


