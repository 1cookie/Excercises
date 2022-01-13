<?php

/**
* "the-stealth-warrior" gets converted to "theStealthWarrior"
* "The_Stealth_Warrior" gets converted to "TheStealthWarrior"
*/
function toCamelCase($str){
  return preg_replace_callback("~[_-](\w)~", function($m) { return strtoupper($m[1]); }, $str);
}

/**
* Reverse words > 5 in a string
*/
function spinWords(string $str) {
    return implode(' ', array_map(function($s){
        return (strlen($s) > 5) ? strrev($s) : $s;
    }, explode(' ', $str)));
}
echo spinWords("Is this word greater than five?");


/**
* Reverse words in a string
*/
function reverseWords($str) {
  return implode(' ', array_map('strrev', explode(' ', $str)));
}


/**
* Returns the number of vowels in a string
*/
function vowelCount(array $arrStr): int
{
    $vowelsCount = 0;

    foreach($arrStr as $v){
        if(in_array($v, ['a','e','i','o','u'] ) ){
            $vowelsCount++;
        }
    }

    return $vowelsCount;
}
echo vowelCount(str_split("a e dkd ddk aaeei")); // 7


// Same result as above but less verbose/more cryptic
$vowelsCount = 0;
$result = array_map(function($s) use($vowelsCount){
if(in_array($s, ['a','e','i','o','u'] ) ){
    $vowelsCount++;
}
    return $vowelsCount;
}, str_split("a e dkd ddk aaeei"));

var_dump(array_sum($result)); // 7

/**
* More succinct
*/
function getCount($str) {
  return preg_match_all('/[aeiou]/i',$str,$matches);
}

/**
* Roman Numerals Decoder
*/
function solution($roman) {
   
    $symbols = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    ];
    
    $numerals = str_split($roman);
    
    foreach($numerals as $i => $n){
        $decimals[$i] = $symbols[$n];
        foreach($decimals as $k => $v){
            if(!empty($decimals[$k+1]) && $decimals[$k+1] > $decimals[$k] ){
                $decimals[$k+1] = ($decimals[$k+1] - $decimals[$k]);
                $decimals[$k] = 0;
            }
        }
    }
    return array_sum($decimals);
}

// PHPUnit Test Examples:
public function testBasics() {
  $this->assertEquals(1000, solution("M"));
  $this->assertEquals(50, solution("L"));
  $this->assertEquals(4, solution("IV"));
}

public function testComplex() {
  $this->assertEquals(2017, solution("MMXVII"));
  $this->assertEquals(1337, solution("MCCCXXXVII"));
}

/**
* https://en.wikipedia.org/wiki/Narcissistic_number
*/
function narcissistic(int $value): bool {
    
  $n = ceil(log10(abs($value) + 1));
  $digits  = array_map('intval', str_split($value));
  
  $exps = array_map(function($d) use($n){
      return pow($d,$n);
  }, $digits);
  
  return ((int)array_sum($exps) === $value);
}


