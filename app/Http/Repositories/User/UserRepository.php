<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 11:25 PM
 */

namespace App\Http\Repositories\User;


use App\Http\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}

