<?php

declare(strict_types=1);

namespace App\Http\Enums;

abstract class MainEnums
{
    public const AUTHORISED = 'authorised',
        DECLINED = 'decline',
        REFUNDED = 'refunded';

    public const FILES_STRUCTURE = [
        'dataProviderX' => [
            'email' => 'parentEmail',
            'currency' => 'Currency',
            'status' => 'statusCode',
            'balance' => 'parentAmount',
            'statusCodes' => [
                '1' => self::AUTHORISED,
                '2' => self::DECLINED,
                '3' => self::REFUNDED,
            ]
        ],
        'dataProviderY' => [
            'email' => 'email',
            'currency' => 'currency',
            'status' => 'status',
            'balance' => 'balance',
            'statusCodes' => [
                '100' => self::AUTHORISED,
                '200' => self::DECLINED,
                '300' => self::REFUNDED,
            ]
        ],
    ];

    public static function getStatuses(): array
    {
        return [
            self::AUTHORISED,
            self::DECLINED,
            self::REFUNDED
        ];
    }

    public static function getFileNames(): array
    {
        return array_keys(self::FILES_STRUCTURE);
    }
}