<?php return [
    'plugin' => [
        'name' => 'Extended Builder Plugin',
        'description' => '这个插件扩展了RainLab Builder插件,从数据库列自动生成YAML表单框架,以便在Builder中进行编辑。',
        'extended_description' => '此插件扩展了RainLab Builder插件。通过自动生成基本YAML表单以及从模型表列批量生成的字段,节省表单创建时间。此后,您可以使用RainLab Builder配置和自定义表单。',
        'use' => '如何使用',
        'use_description' => '&bull;安装插件。<br/>&bull;导航到菜单上的<strong>自动字段</strong>和&bull;选择你的插件<br/>&bull;选择型号<br/>&bull;为每个表格列设置字段选项<br/>&bull;点击<strong>生成表单</strong> <br/>&bull;在<strong> RainLab Builder </strong>中打开生成的YAML表单并配置/自定义它。<br/> <br/> <p> <strong>请注意：</strong>此插件生成基本骨架。您仍然需要通过RainLab Builder正确配置表单字段或手动编辑YAML文件,否则表单可能无法正常运行。</p>',
        'search' => '搜索...',
        'filter_description' => '显示所有插件或仅显示插件。',
        'no_description' => '没有为此插件提供说明',
    ],
    'autofields' => '自动场',
    'model' => [
        'search' => '搜索...',
    ],
    'common' => [
        'select_plugin_first' => '请先选择一个插件。要查看插件列表,请单击左侧边栏上的>图标。',
        'plugin_not_selected' => '插件未被选中',
        'generate_fields' => '生成字段',
        'form_name' => '表单名称',
        'form_name_description' => '请注意：您可能希望使用不存在的文件名并稍后重命名 - 现有的YAML表单将被覆盖！',
        'list_fields' => '数据库字段',
        'skip' => '跳过',
        'field_type' => '字段类型',
        'add_tab' => '添加标签',
        'tab_order' => '标签＃',
        'generate' => '生成表',
    ]
];