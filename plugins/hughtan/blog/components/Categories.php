<?php namespace Hughtan\Blog\Components;

use Db;
use Carbon\Carbon;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Hughtan\Blog\Models\Category as BlogCategory;

class Categories extends ComponentBase
{
    /**
     * @var Collection A collection of categories to display
     */
    public $categories;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $categoryPage;

    /**
     * @var string Reference to the current category slug.
     */
    public $currentCategorySlug;

    public function componentDetails()
    {
        return [
            'name'        => 'hughtan.blog::lang.settings.category_title',
            'description' => 'hughtan.blog::lang.settings.category_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'hughtan.blog::lang.settings.category_slug',
                'description' => 'hughtan.blog::lang.settings.category_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
            'displayEmpty' => [
                'title'       => 'hughtan.blog::lang.settings.category_display_empty',
                'description' => 'hughtan.blog::lang.settings.category_display_empty_description',
                'type'        => 'checkbox',
                'default'     => 0,
            ],
            'categoryPage' => [
                'title'       => 'hughtan.blog::lang.settings.category_page',
                'description' => 'hughtan.blog::lang.settings.category_page_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
                'group'       => 'hughtan.blog::lang.settings.group_links',
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->currentCategorySlug = $this->page['currentCategorySlug'] = $this->property('slug');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->categories = $this->page['categories'] = $this->loadCategories();
    }

    /**
     * Load all categories or, depending on the <displayEmpty> option, only those that have blog posts
     * @return mixed
     */
    protected function loadCategories()
    {
        if (!$this->property('displayEmpty')) {
            $categories = BlogCategory::whereExists(function($query) {
                $prefix = Db::getTablePrefix();

                $query
                    ->select(Db::raw(1))
                    ->from('hughtan_blog_posts_categories')
                    ->join('hughtan_blog_posts', 'hughtan_blog_posts.id', '=', 'hughtan_blog_posts_categories.post_id')
                    ->whereNotNull('hughtan_blog_posts.published')
                    ->where('hughtan_blog_posts.published', '=', 1)
                    ->whereNotNull('hughtan_blog_posts.published_at')
                    ->where('hughtan_blog_posts.published_at', '<', Carbon::now())
                    ->whereRaw($prefix.'hughtan_blog_categories.id = '.$prefix.'hughtan_blog_posts_categories.category_id')
                ;
            });
            $categories = $categories->getNested();
        }
        else {
            $categories = BlogCategory::getNested();
        }

        /*
         * Add a "url" helper attribute for linking to each category
         */
        return $this->linkCategories($categories);
    }

    protected function linkCategories($categories)
    {
        return $categories->each(function($category) {
            $category->setUrl($this->categoryPage, $this->controller);

            if ($category->children) {
                $this->linkCategories($category->children);
            }
        });
    }
}
