<?php /** @noinspection SpellCheckingInspection */

const TESTS = [
    'abba'      => true,
    'abc'       => false,
    'abcbfa'    => true,
    'acbba'     => true,
    'ac'        => true
];

function checkIsPalindrome($string, $useStrong): bool
{
    $leftIndex  = 0;
    $rightIndex = strlen($string) - 1;

    while ($leftIndex < $rightIndex) {
        $isEqual = $string[$leftIndex] === $string[$rightIndex];

        if (!$isEqual) {
            if ($useStrong) {
                return false;
            }

            $charsCount = $rightIndex - $leftIndex;
            $leftStr    = substr($string, $leftIndex, $charsCount);
            $rightStr   = substr($string, $leftIndex + 1, $charsCount);

            return checkIsPalindrome($leftStr, true)
                || checkIsPalindrome($rightStr, true);
        }

        $leftIndex ++;
        $rightIndex --;
    }

    return true;
}

function main($testsList)
{
    foreach ($testsList as $string => $correctValue) {
        $isCorrect = checkIsPalindrome($string, false) === $correctValue;

        $correctValueStr = $correctValue ? 'true' : 'false';
        if ($isCorrect) {
            print "[v] $string is $correctValueStr";
        } else {
            print "[x] $string might be $correctValueStr";
        }
        print "\n";
    }
}

main(TESTS);
