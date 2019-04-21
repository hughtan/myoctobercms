<?php namespace Hughtan\Blog;

use Backend;
use Controller;
use Hughtan\Blog\Models\Post;
use System\Classes\PluginBase;
use Hughtan\Blog\Classes\TagProcessor;
use Hughtan\Blog\Models\Category;
use Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'hughtan.blog::lang.plugin.name',
            'description' => 'hughtan.blog::lang.plugin.description',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-pencil',
            'homepage'    => 'https://github.com/hughtan/blog-plugin'
        ];
    }

    public function registerComponents()
    {
        return [
            'Hughtan\Blog\Components\Post'       => 'blogPost',
            'Hughtan\Blog\Components\Posts'      => 'blogPosts',
            'Hughtan\Blog\Components\Categories' => 'blogCategories',
            'Hughtan\Blog\Components\RssFeed'    => 'blogRssFeed'
        ];
    }

    public function registerPermissions()
    {
        return [
            'hughtan.blog.access_posts' => [
                'tab'   => 'hughtan.blog::lang.blog.tab',
                'label' => 'hughtan.blog::lang.blog.access_posts'
            ],
            'hughtan.blog.access_categories' => [
                'tab'   => 'hughtan.blog::lang.blog.tab',
                'label' => 'hughtan.blog::lang.blog.access_categories'
            ],
            'hughtan.blog.access_other_posts' => [
                'tab'   => 'hughtan.blog::lang.blog.tab',
                'label' => 'hughtan.blog::lang.blog.access_other_posts'
            ],
            'hughtan.blog.access_import_export' => [
                'tab'   => 'hughtan.blog::lang.blog.tab',
                'label' => 'hughtan.blog::lang.blog.access_import_export'
            ],
            'hughtan.blog.access_publish' => [
                'tab'   => 'hughtan.blog::lang.blog.tab',
                'label' => 'hughtan.blog::lang.blog.access_publish'
            ]
        ];
    }

    public function registerNavigation()
    {
        return [
            'blog' => [
                'label'       => 'hughtan.blog::lang.blog.menu_label',
                'url'         => Backend::url('hughtan/blog/posts'),
                'icon'        => 'icon-pencil',
                'iconSvg'     => 'plugins/hughtan/blog/assets/images/blog-icon.svg',
                'permissions' => ['hughtan.blog.*'],
                'order'       => 300,

                'sideMenu' => [
                    'new_post' => [
                        'label'       => 'hughtan.blog::lang.posts.new_post',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('hughtan/blog/posts/create'),
                        'permissions' => ['hughtan.blog.access_posts']
                    ],
                    'posts' => [
                        'label'       => 'hughtan.blog::lang.blog.posts',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('hughtan/blog/posts'),
                        'permissions' => ['hughtan.blog.access_posts']
                    ],
                    'categories' => [
                        'label'       => 'hughtan.blog::lang.blog.categories',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('hughtan/blog/categories'),
                        'permissions' => ['hughtan.blog.access_categories']
                    ]
                ]
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register()
    {
        /*
         * Register the image tag processing callback
         */
        TagProcessor::instance()->registerCallback(function($input, $preview) {
            if (!$preview) {
                return $input;
            }

            return preg_replace('|\<img src="image" alt="([0-9]+)"([^>]*)\/>|m',
                '<span class="image-placeholder" data-index="$1">
                    <span class="upload-dropzone">
                        <span class="label">Click or drop an image...</span>
                        <span class="indicator"></span>
                    </span>
                </span>',
            $input);
        });
    }

    public function boot()
    {
        /*
         * Register menu items for the Hughtan.Pages plugin
         */
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'blog-category'       => 'hughtan.blog::lang.menuitem.blog_category',
                'all-blog-categories' => 'hughtan.blog::lang.menuitem.all_blog_categories',
                'blog-post'           => 'hughtan.blog::lang.menuitem.blog_post',
                'all-blog-posts'      => 'hughtan.blog::lang.menuitem.all_blog_posts',
                'category-blog-posts' => 'hughtan.blog::lang.menuitem.category_blog_posts',
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'blog-category' || $type == 'all-blog-categories') {
                return Category::getMenuTypeInfo($type);
            }
            elseif ($type == 'blog-post' || $type == 'all-blog-posts' || $type == 'category-blog-posts') {
                return Post::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'blog-category' || $type == 'all-blog-categories') {
                return Category::resolveMenuItem($item, $url, $theme);
            }
            elseif ($type == 'blog-post' || $type == 'all-blog-posts' || $type == 'category-blog-posts') {
                return Post::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
