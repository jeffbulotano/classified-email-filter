<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FilterClassifiedEmailRequest;
use App\Services\ClassifiedEmailService;

class ClassifiedEmailController extends Controller
{
    /**
     * Classified email controller
     * 
     * @param ClassifiedEmailService $classifiedEmailService
     */
    public function __construct(private ClassifiedEmailService $classifiedEmailService)
    {
    }

    public function filterClassfiedEmail(FilterClassifiedEmailRequest $request)
    {
        $responseData = $this->classifiedEmailService->filterClassfiedEmail(
            $request->classified_words_phrases,
            $request->email_text
        );

        return response()->json($responseData);
    }
}
