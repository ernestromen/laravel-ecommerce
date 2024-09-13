<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Events\testEvent;
use App\Services\DownloadTableData;

class PageController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view("dashboard", ['users' => $users, 'roles' => $roles, 'permissions' => $permissions]);
    }

    public function downloadCsv($entityName)
    {
        return DownloadTableData::execute($entityName);
    }
}
