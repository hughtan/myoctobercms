<?php return [
    'plugin' => [
        'name' => '导入',
        'description' => '您可以（批量）上传您的自定义插件和主题,它们将在October CMS的相应部分中提供。这些插件和主题类似于您使用Builder创建的插件或您在October CMS中创建的主题,因为它们无法从October CMS市场自动更新。',
        'notice' => '您需要退出然后重新登录才能运行数据库迁移并完成上传插件的安装。',
        'warning' => '插件和主题将上传并提取到各自的文件夹中。在上传的档案中找到的文件夹将覆盖现有文件夹,如果它们具有相同的名称！',
        'success' => '档案提取！',
        'error' => '提取档案时出错',
        'invalid' => '无效的存档（.zip）！',
        'empty' => '上传档案（.zip）！',
        'upload' => '上传并提取',
        'label' => '上传.zip档案',
        'hint' => '例如Demo.zip',
        'plugins' => '插件',
        'themes' => '主题',
    ]
];