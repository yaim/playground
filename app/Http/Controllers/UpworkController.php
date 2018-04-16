<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UpworkController extends CrudController
{
    public function setup() {
        $this->crud->setModel('App\User');
        $this->crud->setRoute('upwork/pg010e53fd1cb4eab86e');
        $this->crud->setEntityNameStrings('user', 'users');

        $this->crud->setColumns(['name', 'email']);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name'
        ]);

        $this->crud->addField([
            'name' => 'email',
            'label' => 'Email'
        ]);

        $this->crud->addButtonFromView('top', 'excel', 'excel', 'end');
    }

    public function store()
    {
        return parent::storeCrud();
    }

    public function update()
    {
        return parent::updateCrud();
    }

    public function export()
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="users.xls"');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');

        $users = User::all()->toArray();

        $i = 2;

        foreach ($users as $user) {
            $sheet->setCellValue('A'.$i, $user['name']);
            $sheet->setCellValue('B'.$i, $user['email']);

            $i++;
        }


        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}
