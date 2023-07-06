<?php

namespace App\Enums;

enum Platform: int
{
    case GITHUB = 0;
    case FRONTEND_MENTOR = 1;
    case TWITTER = 2;
    case LINKEDIN = 3;
    case YOUTUBE = 4;
    case FACEBOOK = 5;
    case TWITCH = 6;
    case DEVTO = 7;
    case CODEWARS = 8;
    case CODEPEN = 9;
    case FREECODECAMP = 10;
    case GITLAB = 11;
    case HASHNODE = 12;
    case STACK_OVERFLOW = 13;

    public function name(): string
    {
        return match($this) {
            self::GITHUB => 'Github',
            self::FRONTEND_MENTOR => 'Frontend Mentor',
            self::TWITTER => 'Twitter',
            self::LINKEDIN => 'LinkedIn',
            self::YOUTUBE => 'Youtube',
            self::FACEBOOK => 'Facebook',
            self::TWITCH => 'Twitch',
            self::DEVTO => 'Dev.to',
            self::CODEWARS => 'Codewars',
            self::CODEPEN => 'Codepen',
            self::FREECODECAMP => 'freeCodeCamp',
            self::GITLAB => 'GitLab',
            self::HASHNODE => 'Hashnode',
            self::STACK_OVERFLOW => 'Stack Overflow',
        };
    }
}
