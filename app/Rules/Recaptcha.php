<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Throwable;

class Recaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secret = (string) config('recaptcha.secret');

        if ($secret === '') {
            $fail('reCAPTCHA 尚未正確設定。');
            return;
        }

        try {
            $response = Http::asForm()
                ->timeout((int) config('recaptcha.timeout', 3))
                ->retry((int) config('recaptcha.retries', 2), 200)
                ->post((string) config('recaptcha.verify_url'), [
                    'secret' => $secret,
                    'response' => (string) $value,
                    'remoteip' => request()->ip(),
                ]);

            if (! $response->successful() || $response->json('success') !== true) {
                $fail('reCAPTCHA 驗證失敗，請重新勾選後再試。');
            }
        } catch (Throwable) {
            $fail('reCAPTCHA 服務暫時無法連線，請稍後再試。');
        }
    }
}
