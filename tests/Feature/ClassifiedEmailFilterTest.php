<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ClassifiedEmailFilterTest extends TestCase
{
    /**
     * Test that the filter-classified-email endpoint returns status code 200
     */
    public function test_api_endpoint_returns_a_successful_response(): void
    {
        $response = $this->post(
            'api/filter-classified-email',
            [
                'classified_words_phrases' => ['word', 'classified phrase'],
                'email_text' => 'Email body.'
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * Test that the filter classified email endpoint returns correct json response
     */
    public function test_api_endpoint_returns_correct_json_response(): void
    {
        $response = $this->post(
            'api/filter-classified-email',
            [
                'classified_words_phrases' => ['word', 'classified phrase'],
                'email_text' => 'Email body.'
            ]
        );

        $response->assertJson(function (AssertableJson $json) {
            $json->hasAll(['is_classified', 'censored_text']);
        });
    }

    /**
     * Test that results are correct when classified word or phrase is found
     */
    public function test_that_response_values_are_correct_when_phrase_is_found(): void
    {
        $response = $this->post(
            'api/filter-classified-email',
            [
                'classified_words_phrases' => ['word', 'classified phrase'],
                'email_text' => 'Email body that has classified phrase.'
            ]
        );

        $response->assertExactJson([
            'is_classified' => true,
            'censored_text' => 'Email body that has *****.'
        ]);
    }
}
