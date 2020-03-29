<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute 必须被接受',
    'active_url' => ':attribute 不是合法的 URL',
    'after' => ':attribute 必须是 :date 之后的日期',
    'after_or_equal' => ':attribute 必须是 :date 之后或相同的日期',
    'alpha' => ':attribute 只能包含字母',
    'alpha_dash' => ':attribute 只能包含字母、数字、破折号和下划线',
    'alpha_num' => ':attribute 只能包含字母和数字',
    'array' => ':attribute 必须是数组',
    'before' => ':attribute 必须是 :date 之前的日期',
    'before_or_equal' => ':attribute 必须是 :date 之前或相同的日期',
    'between' => [
        'numeric' => ':attribute 必须在 :min 到 :max 之间',
        'file' => ':attribute 必须在 :min 到 :max KB之间',
        'string' => ':attribute 必须在 :min 到 :max 个字符之间',
        'array' => ':attribute 必须在 :min 到 :max 项之间',
    ],
    'boolean' => ':attribute 必须是 true 或 false.',
    'confirmed' => ':attribute 确认不匹配',
    'date' => ':attribute 不是合法的日期',
    'date_equals' => ':attribute 必须与 :date 日期相同',
    'date_format' => ':attribute 与格式 :format 不匹配',
    'different' => ':attribute 和 :other 必须不同',
    'digits' => ':attribute 必须是 :digits 位的数字',
    'digits_between' => ':attribute 必须是 :min 到 :max 位间的数字',
    'dimensions' => ':attribute 具有无效的图片尺寸',
    'distinct' => ':attribute 具有重复值',
    'email' => ':attribute 必须是合法的电子邮件地址',
    'exists' => '选定的 :attribute 是无效的',
    'file' => ':attribute 必须是文件',
    'filled' => ':attribute 是必填项',
    'gt' => [
        'numeric' => ':attribute 必须大于 :value',
        'file' => ':attribute 必须大于 :value KB',
        'string' => ':attribute 必须大于 :value 个字符',
        'array' => ':attribute 必须多于 :value 项',
    ],
    'gte' => [
        'numeric' => ':attribute 必须大于或等于 :value',
        'file' => ':attribute 必须大于或等于 :value KB',
        'string' => ':attribute 必须大于或等于 :value 个字符',
        'array' => ':attribute 必须不少于 :value 项',
    ],
    'image' => ':attribute 必须是图片（bmp、png、jpeg或gif格式）',
    'in' => '选定的 :attribute 是无效的',
    'in_array' => ':attribute 不在 :other 中',
    'integer' => ':attribute 必须是整数',
    'ip' => ':attribute 必须是合法的 IP 地址',
    'ipv4' => ':attribute 必须是合法的 IPv4 地址',
    'ipv6' => ':attribute 必须是合法的 IPv6 地址',
    'json' => ':attribute 必须是合法的 JSON 字符串',
    'lt' => [
        'numeric' => ':attribute 必须小于 :value',
        'file' => ':attribute 必须小于 :value KB',
        'string' => ':attribute 必须小于 :value 个字符',
        'array' => ':attribute 必须少于 :value 项',
    ],
    'lte' => [
        'numeric' => ':attribute 必须小于或等于 :value',
        'file' => ':attribute 必须小于或等于 :value KB',
        'string' => ':attribute 必须小于或等于 :value 个字符',
        'array' => ':attribute 必须不多于 :value 项',
    ],
    'max' => [
        'numeric' => ':attribute 最大值为 :max',
        'file' => ':attribute 最大为 :max KB',
        'string' => ':attribute 最多为 :max 个字符',
        'array' => ':attribute 最多为 :max 项',
    ],
    'mimes' => ':attribute 的文件类型必须是: :values.',
    'mimetypes' => ':attribute 的文件类型必须是: :values.',
    'min' => [
        'numeric' => ':attribute 最小值为 :min',
        'file' => ':attribute 最小为 :min KB',
        'string' => ':attribute 最少为 :min 个字符',
        'array' => ':attribute 最少为 :min 项',
    ],
    'not_in' => '选定的 :attribute 是无效的',
    'not_regex' => ':attribute 格式无效',
    'numeric' => ':attribute 必须是数字',
    'present' => ':attribute 必须存在',
    'regex' => ':attribute 格式无效',
    'required' => ':attribute 必须填写',
    'required_if' => ':attribute 当 :other 是 :value 时必须填写',
    'required_unless' => ':attribute 必须填写，除非 :other 在 :values 中',
    'required_with' => ':attribute 当 :values 存在时必须填写',
    'required_with_all' => ':attribute 当 :values 都存在时必须填写',
    'required_without' => ':attribute 当 :values 不存在时必须填写',
    'required_without_all' => ':attribute 当 :values 都不存在时必须填写',
    'same' => ':attribute 和 :other 必须匹配',
    'size' => [
        'numeric' => ':attribute 必须是 :size 位',
        'file' => ':attribute 必须是 :size KB',
        'string' => ':attribute 必须是 :size 个字符',
        'array' => ':attribute 必须包含 :size 项',
    ],
    'starts_with' => ':attribute 必须以其中一个值开头: :values',
    'string' => ':attribute 必须是字符串',
    'timezone' => ':attribute 必须是有效时区',
    'unique' => ':attribute 已存在',
    'uploaded' => ':attribute 上传失败',
    'url' => ':attribute 格式无效',
    'uuid' => ':attribute 必须是有效的 UUID.',
    'captcha' => ':attribute 不正确',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'username' => '用户名',
        'password' => '密码',
        'captcha' => '验证码',
        'email' => '电子邮箱',
        'phone' => '联系电话',
        'leader' => '学校联系人',
        'leader_phone' => '学校联系人电话',
        'idnumber' => '身份证号',
        'syllabus' => '教学大纲',
        'design' => '教学设计',
        'section' => '教学节段PPT',
        'catalog' => '教学节段目录',
        'memo' => '备注',
        'description' => '描述',
        'name' => '名称',
        'year' => '年度',
        'begin_at' => '开始时间',
        'end_at' => '结束时间',
        'user_id' => '用户ID',
        'birthday' => '出生日期',
        'position' => '职称',
        'teaching_begin_time' => '开始本科教学时间',
        'course' => '参赛课程',
        'major' => '专业',
        'direction' => '研究方向',
        'live_score' => '课堂教学得分',
        'reflection_score' => '课堂反思得分',
    ],

];
