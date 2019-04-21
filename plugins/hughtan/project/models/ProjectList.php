<?php namespace Hughtan\project\Models;

use Model;
use Hughtan\Builder\Classes\IconList;

/**
 * Model
 */
class ProjectList extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'hughtan_project_lists';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    public function getIconOptions()
    {
        return IconList::getList();
    }
    public $attachOne = [
        'file'  => ['System\Models\File']
    ];



}
