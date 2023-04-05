<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class UsersSheet extends StringValueBinder implements WithCustomValueBinder, FromView, WithHeadings
{
    protected $role;
    protected $title;

    public function __construct($role, $title)
    {
        $this->role = $role;
        $this->title = $title;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.users', [
            'users' => $this->role->users,
            'title' => $this->title
        ]);
    }

    public function headings(): array
    {

        return [
            'Name',
            'Email',
            'Parent',
            'Created At',
            'Updated At',
        ];
    }
}
