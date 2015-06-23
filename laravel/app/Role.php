<?php

// Roles hierarchy
// Roles: Project Viewer, Editor, Subscriber, etc.
// Permissions: Can view project, can edit project, etc.

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
}