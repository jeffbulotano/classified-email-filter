<?php

namespace App\Services;

use App\Constants\ClassifiedEmailConstant;

class ClassifiedEmailService
{
    /**
     * Detect potential classified mail.
     * - Accept a list of of classified words or phrases as first parameter
     * - Accept an email text as second parameter
     * - Count the occurance of classified words or phrases detected
     * - Replace all exact occurances of classified words and phrases in the email text with a masking word ***** in this instance
     * - Return two values: 
     *   - bool: value that is true if classified words or phrases were found
     *   - censored text: version of email text with classified content replaced with asterisks 
     * 
     * ASSUMPTIONS:
     * - Search is case insensitive
     * - Search needs to match exact word e.g. if the classified word is "the", it should not replace them in the text.
     * - Classified text found will be replaced with a fixed mask string "*****" regardless if it has multiple words
     * 
     * @param array  $classifiedWordsPhrases
     * @param string $emailText
     * @return array
     */
    public function filterClassifiedEmail(
        array $classifiedWordsPhrases,
        string $emailText
    ): array {
        $classifiedTextCount = 0;
        $regexSearch = [];

        foreach ($classifiedWordsPhrases as $searchString) {
            // Replacing words and phrases with regex pattern to add word boundaries and make them case insensitive
            $regexSearch[] = '/\b' . $searchString . '\b/i';
        }

        $emailText = preg_replace(
            $regexSearch,
            ClassifiedEmailConstant::MASK_CHARACTERS,
            $emailText,
            -1,
            $classifiedTextCount
        );

        return [
            'is_classified' => $classifiedTextCount > 0,
            'censored_text' => $emailText
        ];
    }

    /**
     * This alternate solution is created to demonstrate the simplest solution 
     * for replacing classsified text
     * 
     * LIMITATIONS:
     * - The search is not matching exact words. E.g. if the classified word is "the", it will replace "them" with "*****m"
     * 
     * If the mentioned limitations are not important, then this solution is recommended for performance.
     * 
     * @param array  $classifiedWordsPhrases
     * @param string $emailText
     * @return array
     */
    public function filterClassifiedEmailAlt(
        array $classifiedWordsPhrases,
        string $emailText
    ): array {
        $classifiedTextCount = 0;

        $censoredText = str_ireplace(
            $classifiedWordsPhrases,
            ClassifiedEmailConstant::MASK_CHARACTERS,
            $emailText,
            $classifiedTextCount
        );

        return [
            'is_classified' => $classifiedTextCount > 0,
            'censored_text' => $censoredText
        ];
    }
}
