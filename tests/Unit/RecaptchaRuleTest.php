<?php

namespace Tests\Unit;

use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RecaptchaRuleTest extends TestCase
{
    public function test_it_accepts_a_successful_google_verification(): void
    {
        config()->set('recaptcha.secret', 'test-secret');
        Http::fake(['*' => Http::response(['success' => true])]);

        $validator = Validator::make(
            ['g-recaptcha-response' => 'token'],
            ['g-recaptcha-response' => [new Recaptcha()]],
        );

        $this->assertFalse($validator->fails());
    }

    public function test_it_rejects_an_unsuccessful_google_verification(): void
    {
        config()->set('recaptcha.secret', 'test-secret');
        Http::fake(['*' => Http::response(['success' => false])]);

        $validator = Validator::make(
            ['g-recaptcha-response' => 'token'],
            ['g-recaptcha-response' => [new Recaptcha()]],
        );

        $this->assertTrue($validator->fails());
    }
}
