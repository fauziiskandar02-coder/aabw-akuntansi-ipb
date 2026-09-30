<?php

if (!function_exists('logged_in')) {
    function logged_in(): bool
    {
        return (bool) session()->get('logged_in');
    }
}

if (!function_exists('user')) {
    function user(): ?object
    {
        $userData = session()->get('user');
        if ($userData) {
            return (object) $userData;
        }

        // Default fallback if not logged in or during dev
        return (object) [
            'id'       => 1,
            'username' => 'admin',
            'email'    => 'admin@aabw.com',
            'fullname' => 'Fauzi Iskandar',
            'user_img' => 'avatar-1.png',
            'role'     => 'admin',
        ];
    }
}

if (!function_exists('user_id')) {
    function user_id(): ?int
    {
        $u = user();
        return $u ? (int) $u->id : null;
    }
}

if (!function_exists('in_groups')) {
    function in_groups($group): bool
    {
        $u = user();
        if (!$u || empty($u->role)) {
            return false;
        }
        if (is_array($group)) {
            return in_array($u->role, $group);
        }
        return $u->role === $group;
    }
}
