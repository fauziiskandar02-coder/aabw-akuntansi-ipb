<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

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

        // Default fallback
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
