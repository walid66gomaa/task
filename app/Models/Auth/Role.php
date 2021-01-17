<?php

namespace App\Models\Auth;

use Spatie\Permission\Models\Role as spatierole;
use App\Models\Auth\Traits\Method\RoleMethod;
use App\Models\Auth\Traits\Attribute\RoleAttribute;

/**
 * Class Role.
 */
class Role extends spatierole
{
    use RoleAttribute,
        RoleMethod;
}
