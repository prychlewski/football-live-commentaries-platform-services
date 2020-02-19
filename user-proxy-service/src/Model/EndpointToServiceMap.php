<?php

namespace App\Model;

class EndpointToServiceMap
{
    public const FOOTBALL_MATCH_SERVICE_ENDPOINTS = [
        'football_match_add',
        'football_match_edit',
        'football_match_delete',
        'football_match_view',
        'football_match_goal',
    ];

    public const COMMENT_SERVICE_ENDPOINTS = [
        'comment_add',
        'comment_edit',
        'comment_delete',
        'comments_view',
    ];

    public const TEAM_SERVICE_ENDPOINTS = [
        'team_add',
        'team_edit',
        'team_delete',
        'team_view',
    ];

    public const USER_SERVICE_ENDPOINTS = [
        'user_register',
        'user_add_admin',
        'user_me',
    ];

    public static function resolveHostUsingRouteName(string $endpointName): ?string
    {
        switch(true) {
            case in_array($endpointName, self::FOOTBALL_MATCH_SERVICE_ENDPOINTS, true):
                return 'football-match.service:8080';
            case in_array($endpointName, self::COMMENT_SERVICE_ENDPOINTS, true):
                return 'relation.service:8080';
            case in_array($endpointName, self::TEAM_SERVICE_ENDPOINTS, true):
                return 'team.service:8080';
            default:
                return null;
        }
    }
}
