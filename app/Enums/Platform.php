<?php

namespace App\Enums;

enum Platform: string
{
    case GITHUB = 'Github';
    case FRONTEND_MENTOR = 'Frontend Mentor';
    case TWITTER = 'Twitter';
    case LINKEDIN = 'LinkedIn';
    case YOUTUBE = 'Youtube';
    case FACEBOOK = 'Facebook';
    case TWITCH = 'Twitch';
    case DEVTO = 'Dev.to';
    case CODEWARS = 'Codewars';
    case CODEPEN = 'Codepen';
    case FREECODECAMP = 'freeCodeCamp';
    case GITLAB = 'GitLab';
    case HASHNODE = 'Hashnode';
    case STACK_OVERFLOW = 'Stack Overflow';
}
