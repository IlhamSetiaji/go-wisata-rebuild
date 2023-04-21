<?php

namespace App\Exports;

use App\Exports\UsersSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersExport implements WithMultipleSheets
{
    use Exportable;
    protected $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->roles as $key => $role) {
            $name = ucwords(str_replace('-', ' ', $role->name));
            $sheets[] = new UsersSheet($role, $name);
        }
        return $sheets;
    }
}
