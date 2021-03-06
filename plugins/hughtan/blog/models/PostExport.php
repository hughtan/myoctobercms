<?php namespace Hughtan\Blog\Models;

use Backend\Models\ExportModel;
use ApplicationException;

/**
 * Post Export Model
 */
class PostExport extends ExportModel
{
    public $table = 'hughtan_blog_posts';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'post_user' => [
            'Backend\Models\User',
            'key' => 'user_id'
        ]
    ];

    public $belongsToMany = [
        'post_categories' => [
            'Hughtan\Blog\Models\Category',
            'table'    => 'hughtan_blog_posts_categories',
            'key'      => 'post_id',
            'otherKey' => 'category_id'
        ]
    ];

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = [
        'author_email',
        'categories'
    ];

    public function exportData($columns, $sessionKey = null)
    {
        $result = self::make()
            ->with([
                'post_user',
                'post_categories'
            ])
            ->get()
            ->toArray()
        ;

        return $result;
    }

    public function getAuthorEmailAttribute()
    {
        if (!$this->post_user) {
            return '';
        }

        return $this->post_user->email;
    }

    public function getCategoriesAttribute()
    {
        if (!$this->post_categories) {
            return '';
        }

        return $this->encodeArrayValue($this->post_categories->lists('name'));
    }
}
