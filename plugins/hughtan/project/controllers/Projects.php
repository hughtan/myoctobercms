<?php namespace Hughtan\project\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Projects extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Hughtan.project', 'main-menu-item');
    }
    public function create()
    {
        BackendMenu::setContextSideMenu('main-menu-item');


        return $this->asExtension('FormController')->create();
    }



}