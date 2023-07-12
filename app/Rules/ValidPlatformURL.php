<?php

namespace App\Rules;

use App\Enums\Platform;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPlatformURL implements ValidationRule
{
    public function __construct(public array $links) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->links as $link) {
            $platform = Platform::from($link['platform']);

            $platformURL = $this->getValidURLForPlatform($platform);

            if (!str($link['url'])->startsWith($platformURL)) {
                $fail('Invalid platform URL');
            }
        }
    }

    private function getValidURLForPlatform(Platform $platform)
    {
        return match ($platform) {
            Platform::GITHUB => 'https://github.com',
            Platform::FRONTEND_MENTOR => 'https://www.frontendmentor.io',
            Platform::TWITTER => 'https://twitter.com',
            Platform::LINKEDIN => 'https://www.linkedin.com',
            Platform::YOUTUBE => 'https://youtube.com',
            Platform::FACEBOOK => 'https://www.facebook.com',
            Platform::TWITCH => 'https://www.twitch.tv',
            Platform::DEVTO => 'https://dev.to',
            Platform::CODEWARS => 'https://www.codewars.com',
            Platform::CODEPEN => 'https://codepen.io',
            Platform::FREECODECAMP => 'https://www.freecodecamp.org',
            Platform::GITLAB => 'https://gitlab.com',
            Platform::HASHNODE => 'https://hashnode.com',
            Platform::STACK_OVERFLOW => 'https://stackoverflow.com',
        };
    }
}
