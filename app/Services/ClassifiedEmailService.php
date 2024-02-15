<?php

namespace App\Services;

class ClassifiedEmailService
{
    /**
     * Che
     * 
     * @param array  $classifiedWordsPhrases
     * @param string $emailText
     * @return array
     */
    public function filterClassfiedEmail(
        array $classifiedWordsPhrases,
        string $emailText
    ): array {
        return [
            'is_classified' => null,
            'censored_text' => null
        ];
    }
}
