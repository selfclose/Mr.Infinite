<?php
namespace vendor\wp_infinite\Provider;

class WP_UsersProvider
{
    /**
     * @param string $display_name
     * @return bool|int
     */
    public static function getIdFromDisplayName($display_name)
    {
        $users = get_users([
            'meta_key' => 'display_name',
            'meta_value' => 'admin'
        ]);

        return isset( $users[0] ) ? $users[0]->ID : false;
    }
}
