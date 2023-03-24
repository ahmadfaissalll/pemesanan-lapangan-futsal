<?php


enum Gender: string
{
  case Male = 'Pria';
  case Female = 'Wanita';
}

function hello(string $name, Gender $gender): string {
  return "Hello $name, $gender->value";
}

echo hello('icall', Gender::Male) . PHP_EOL;