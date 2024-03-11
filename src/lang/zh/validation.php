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

    'accepted' => '必须接受 :attribute ',
    'active_url' => ' :attribute 不是一个有效的网址。',
    'after' => ' :attribute 必须晚于 :date.',
    'after_or_equal' => ' :attribute 必须不早于 :date.',
    'alpha' => ' :attribute 只能包含字母。',
    'alpha_dash' => ' :attribute 只能包含字母、数字、连接号（-）和下划线（_）。',
    'alpha_num' => ' :attribute 只能包含字母和数字。',
    'alpha_space' => ' :attribute 只能包含字母和空格。',
    'alpha_space_dash' => ' :attribute 只能包含字母、连接号（-）和空格。',
    'array' => ' :attribute 必须是数组。',
    'before' => ' :attribute 必须早于 :date.',
    'before_or_equal' => ' :attribute 必须不晚于 :date.',
    'between' => [
        'numeric' => ' :attribute 必须在 :min 和 :max 之间。',
        'file' => ' :attribute 必须在 :min 和 :max KB 之间。',
        'string' => ' :attribute 必须在 :min 和 :max 字符之间。',
        'array' => ' :attribute 必须在 :min 和 :max 项之间。',
    ],
    'boolean' => ' :attribute 必须是“是”或“否”。',
    'chinese' => ' :attribute 只能包含中文。',
    'confirmed' => ' :attribute 确认不匹配。',
    'date' => ' :attribute 不是一个有效的日期。',
    'date_equals' => ' :attribute 必须是 :date.',
    'date_format' => ' :attribute 格式必须是 :format.',
    'different' => ' :attribute 和 :other 必须不同。',
    'digits' => ' :attribute 必须为 :digits 位。',
    'digits_between' => ' :attribute 必须在 :min 到 :max 位之间。',
    'dimensions' => ' :attribute 图片尺寸无效。',
    'distinct' => ' :attribute 不能重复。',
    'email' => ' :attribute 必须是有效的电子邮箱地址。',
    'ends_with' => ' :attribute 必须以： :values 结尾。',
    'exists' => ' :attribute 不存在',
    'file' => ' :attribute 必须是文件。',
    'filled' => ' :attribute 不能为空白。',
    'gt' => [
        'numeric' => ' :attribute 必须大于 :value.',
        'file' => ' :attribute 必须大于 :value KB.',
        'string' => ' :attribute 必须多于 :value 个字符。',
        'array' => ' :attribute 必须多于 :value 项。',
    ],
    'gte' => [
        'numeric' => ' :attribute 不能小于 :value.',
        'file' => ' :attribute 不能小于 :value KB.',
        'string' => ' :attribute 不能少于 :value 个字符。',
        'array' => ' :attribute 不能少于 :value 项。',
    ],
    'image' => ' :attribute 必须是图片。',
    'in' => '无效的选项： :attribute ',
    'in_array' => ' :attribute 在 :other 中不存在。',
    'integer' => ' :attribute 必须是整数。',
    'ip' => ' :attribute 必须是有效的IP地址。',
    'ipv4' => ' :attribute 必须是有效的IPv4地址。',
    'ipv6' => ' :attribute 必须是有效的IPv6地址。',
    'json' => ' :attribute 必须是有效的JSON格式。',
    'lt' => [
        'numeric' => ' :attribute 必须小于 :value.',
        'file' => ' :attribute 必须小于 :value KB.',
        'string' => ' :attribute 必须少于 :value 个字符。',
        'array' => ' :attribute 必须少于 :value 项。',
    ],
    'lte' => [
        'numeric' => ' :attribute 不能大于 :value.',
        'file' => ' :attribute 不能大于 :value KB.',
        'string' => ' :attribute 不能多于 :value 个字符。',
        'array' => ' :attribute 不能多于 :value 项。',
    ],
    'max' => [
        'numeric' => ' :attribute 不能大于 :max.',
        'file' => ' :attribute 不能大于 :max KB.',
        'string' => ' :attribute 不能多于 :max 个字符。',
        'array' => ' :attribute 不能多于 :max 项。',
    ],
    'mimes' => ' :attribute 的文件类型必须是： :values.',
    'mimetypes' => ' :attribute 的文件类型必须是： :values.',
    'min' => [
        'numeric' => ' :attribute 不能小于 :min.',
        'file' => ' :attribute 不能小于 :min KB.',
        'string' => ' :attribute 不能少于 :min 个字符。',
        'array' => ' :attribute 不能少于 :min 项。',
    ],
    'multiple_of' => ' :attribute 必须是 :value 的倍数。',
    'no_alpha_space' => ' :attribute 不能包含字母和空格。',
    'not_in' => '无效的选项： :attribute ',
    'not_regex' => ' :attribute 格式不正确。',
    'numeric' => ' :attribute 必须是数字。',
    'password' => '密码不正确。',
    'present' => ' :attribute 必须存在。',
    'regex' => ' :attribute 格式不正确。',
    'required' => ' :attribute 是必填项。',
    'required_if' => '当 :other 是 :value 时， :attribute 是必填项。',
    'required_unless' => '当 :other 不是 :value 时， :attribute 是必填项。',
    'required_with' => '当 :value 存在时， :attribute 是必填项。',
    'required_with_all' => '当 :values 都存在时， :attribute 是必填项。',
    'required_without' => '当 :values 不存在时， :attribute 是必填项。',
    'required_without_all' => '当 :value 都不存在时， :attribute 是必填项。',
    'prohibited_if' => '当 :other 是 :value 时， :attribute 不能填写。',
    'prohibited_unless' => '当 :other 不是 :values 时， :attribute 不能填写。',
    'same' => ' :attribute 和 :other 必须相同。',
    'size' => [
        'numeric' => ' :attribute 必须是 :size',
        'file' => ' :attribute 必须是 :size KB',
        'string' => ' :attribute 必须是 :size 个字符。',
        'array' => ' :attribute 必须是 :size 项。',
    ],
    'starts_with' => ' :attribute 必须以以下字符开始： :values',
    'string' => ' :attribute 必须是字符。',
    'timezone' => ' :attribute 必须是一个有效的时区。',
    'unique' => ' :attribute 已经被占用。',
    'uploaded' => ' :attribute 上传失败。',
    'url' => ' :attribute 的格式无效。',
    'uuid' => ' :attribute 必须是一个有效的UUID。',

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
        'address' => '地址',
        'baptism' => '受洗年份',
        'birth' => '出生年份',
        'city' => '城市',
        'cn_name' => '中文名',
        'code' => '代码',
        'current_password' => '当前密码',
        'description' => '描述',
        'email' => '电子邮箱',
        'end_date' => '结束日期',
        'first_name' => '名字',
        'last_name' => '姓氏',
        'level' => '等级',
        'location' => '地点',
        'name' => '名字',
        'new_password' => '新密码',
        'new_password_confirmation' => '确认新密码',
        'order' => '排序',
        'region_id' => '地区',
        'password' => '密码',
        'phone' => '电话',
        'qty' => '数量',
        'sex' => '性别',
        'ship_address' => '邮寄地址',
        'start_date' => '开始日期',
        'state' => '州/省',
        'time' => '时间',
        'time_zone' => '时区',
        'zipcode' => '邮编',
    ],

];
