<?php

namespace App\Enums;

enum Platform: int
{
    case GITHUB = 0;
    case YOUTUBE = 1;
    case LINKEDIN = 2;
    case FACEBOOK = 3;
    case FRONTEND_MENTOR = 4;
    case HASHNODE = 5;

    public function name(): string
    {
        return match($this) {
            self::GITHUB => 'Github',
            self::YOUTUBE => 'Youtube',
            self::LINKEDIN => 'LinkedIn',
            self::FACEBOOK => 'Facebook',
            self::FRONTEND_MENTOR => 'Frontend Mentor',
            self::HASHNODE => 'Hashnode',
        };
    }
}
