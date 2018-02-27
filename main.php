<?php
require_once('vendor/autoload.php');

$length = 256;
$arguments = $argv;
unset($arguments[0]);

$game = new AOC10\Game($length, implode('', $arguments));
$hash = $game->process();
print implode('', $hash) . "\n";
