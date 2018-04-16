<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;

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

        $this->crud->enableExportButtons();
    }

    public function store()
    {
        return parent::storeCrud();
    }

    public function update()
    {
        return parent::updateCrud();
    }
}
