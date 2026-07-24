<?php

namespace App\Helpers;

use App\Models\Notification;

class NotifHelper
{
    /**
     * Kirim notifikasi ke user tertentu
     *
     * @param int    $userId  ID user penerima
     * @param string $title   Judul notifikasi
     * @param string $message Isi pesan
     * @param string $type    Tipe: 'info', 'success', 'warning', 'error' (default: 'info')
     * @param string|null $url Link tujuan saat diklik
     */
    public static function send(int $userId, string $title, string $message, string $type = 'info', ?string $url = null): void
    {
        Notification::create([
            'user_id' => $userId,
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
            'data'    => $url ? ['url' => $url] : null,
        ]);
    }

    /**
     * Kirim notifikasi sukses
     */
    public static function success(int $userId, string $title, string $message, ?string $url = null): void
    {
        self::send($userId, $title, $message, 'success', $url);
    }

    /**
     * Kirim notifikasi info
     */
    public static function info(int $userId, string $title, string $message, ?string $url = null): void
    {
        self::send($userId, $title, $message, 'info', $url);
    }

    /**
     * Kirim notifikasi warning
     */
    public static function warning(int $userId, string $title, string $message, ?string $url = null): void
    {
        self::send($userId, $title, $message, 'warning', $url);
    }

    /**
     * Kirim notifikasi error
     */
    public static function error(int $userId, string $title, string $message, ?string $url = null): void
    {
        self::send($userId, $title, $message, 'error', $url);
    }

    /**
     * Kirim notifikasi ke semua user
     */
    public static function broadcast(string $title, string $message, string $type = 'info', ?string $url = null): void
    {
        $userIds = \App\Models\User::pluck('id')->toArray();
        foreach ($userIds as $userId) {
            self::send($userId, $title, $message, $type, $url);
        }
    }

    /**
     * Kirim notifikasi ke multiple users
     */
    public static function sendToUsers(array $userIds, string $title, string $message, string $type = 'info', ?string $url = null): void
    {
        foreach ($userIds as $userId) {
            self::send($userId, $title, $message, $type, $url);
        }
    }
}
