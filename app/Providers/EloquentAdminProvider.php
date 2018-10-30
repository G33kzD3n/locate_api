<?php
namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;

/**
 *
 */
class EloquentAdminProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        // Of course here, you could perform the query yourself with the is_admin comparison, but
        // I think it's best to avoid as much duplication as possible
        $user = parent::retrieveByCredentials($credentials);

        return $user;
    }
}
