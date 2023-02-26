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

    'accepted' => '必須接受 :attribute ',
    'active_url' => ' :attribute 不是一個有效的網址。',
    'after' => ' :attribute 必須晚於 :date.',
    'after_or_equal' => ' :attribute 必須不早於 :date.',
    'alpha' => ' :attribute 只能包含字母。',
    'alpha_dash' => ' :attribute 只能包含字母、數字、連接號（-）和下劃線（_）。',
    'alpha_num' => ' :attribute 只能包含字母和數字。',
    'alpha_space' => ' :attribute 只能包含字母和空格。',
    'alpha_space_dash' => ' :attribute 只能包含字母、連接號（-）和空格。',
    'array' => ' :attribute 必須是數組。',
    'before' => ' :attribute 必須早於 :date.',
    'before_or_equal' => ' :attribute 必須不晚於 :date.',
    'between' => [
        'numeric' => ' :attribute 必須在 :min 和 :max 之間。',
        'file' => ' :attribute 必須在 :min 和 :max KB 之間。',
        'string' => ' :attribute 必須在 :min 和 :max 字符之間。',
        'array' => ' :attribute 必須在 :min 和 :max 項之間。',
    ],
    'boolean' => ' :attribute 必須是“是”或“否”。',
    'chinese' => ' :attribute 只能包含中文。',
    'confirmed' => ' :attribute 確認不匹配。',
    'date' => ' :attribute 不是一個有效的日期。',
    'date_equals' => ' :attribute 必須是 :date.',
    'date_format' => ' :attribute 格式必須是 :format.',
    'different' => ' :attribute 和 :other 必須不同。',
    'digits' => ' :attribute 必須爲 :digits 位。',
    'digits_between' => ' :attribute 必須在 :min 到 :max 位之間。',
    'dimensions' => ' :attribute 圖片尺寸無效。',
    'distinct' => ' :attribute 不能重複。',
    'email' => ' :attribute 必須是有效的電子郵箱地址。',
    'ends_with' => ' :attribute 必須以： :values 結尾。',
    'exists' => ' :attribute 不存在',
    'file' => ' :attribute 必須是文件。',
    'filled' => ' :attribute 不能爲空白。',
    'gt' => [
        'numeric' => ' :attribute 必須大於 :value.',
        'file' => ' :attribute 必須大於 :value KB.',
        'string' => ' :attribute 必須多於 :value 個字符。',
        'array' => ' :attribute 必須多於 :value 項。',
    ],
    'gte' => [
        'numeric' => ' :attribute 不能小於 :value.',
        'file' => ' :attribute 不能小於 :value KB.',
        'string' => ' :attribute 不能少於 :value 個字符。',
        'array' => ' :attribute 不能少於 :value 項。',
    ],
    'image' => ' :attribute 必須是圖片。',
    'in' => '無效的選項： :attribute ',
    'in_array' => ' :attribute 在 :other 中不存在。',
    'integer' => ' :attribute 必須是整數。',
    'ip' => ' :attribute 必須是有效的IP地址。',
    'ipv4' => ' :attribute 必須是有效的IPv4地址。',
    'ipv6' => ' :attribute 必須是有效的IPv6地址。',
    'json' => ' :attribute 必須是有效的JSON格式。',
    'lt' => [
        'numeric' => ' :attribute 必須小於 :value.',
        'file' => ' :attribute 必須小於 :value KB.',
        'string' => ' :attribute 必須少於 :value 個字符。',
        'array' => ' :attribute 必須少於 :value 項。',
    ],
    'lte' => [
        'numeric' => ' :attribute 不能大於 :value.',
        'file' => ' :attribute 不能大於 :value KB.',
        'string' => ' :attribute 不能多於 :value 個字符。',
        'array' => ' :attribute 不能多於 :value 項。',
    ],
    'max' => [
        'numeric' => ' :attribute 不能大於 :max.',
        'file' => ' :attribute 不能大於 :max KB.',
        'string' => ' :attribute 不能多於 :max 個字符。',
        'array' => ' :attribute 不能多於 :max 項。',
    ],
    'mimes' => ' :attribute 的文件類型必須是： :values.',
    'mimetypes' => ' :attribute 的文件類型必須是： :values.',
    'min' => [
        'numeric' => ' :attribute 不能小於 :min.',
        'file' => ' :attribute 不能小於 :min KB.',
        'string' => ' :attribute 不能少於 :min 個字符。',
        'array' => ' :attribute 不能少於 :min 項。',
    ],
    'multiple_of' => ' :attribute 必須是 :value 的倍數。',
    'no_alpha_space' => ' :attribute 不能包含字母和空格。',
    'not_in' => '無效的選項： :attribute ',
    'not_regex' => ' :attribute 格式不正確。',
    'numeric' => ' :attribute 必須是數字。',
    'password' => '密碼不正確。',
    'present' => ' :attribute 必須存在。',
    'regex' => ' :attribute 格式不正確。',
    'required' => ' :attribute 是必填項。',
    'required_if' => '當 :other 是 :value 時， :attribute 是必填項。',
    'required_unless' => '當 :other 不是 :value 時， :attribute 是必填項。',
    'required_with' => '當 :value 存在時， :attribute 是必填項。',
    'required_with_all' => '當 :values 都存在時， :attribute 是必填項。',
    'required_without' => '當 :values 不存在時， :attribute 是必填項。',
    'required_without_all' => '當 :value 都不存在時， :attribute 是必填項。',
    'prohibited_if' => '當 :other 是 :value 時， :attribute 不能填寫。',
    'prohibited_unless' => '當 :other 不是 :values 時， :attribute 不能填寫。',
    'same' => ' :attribute 和 :other 必須相同。',
    'size' => [
        'numeric' => ' :attribute 必須是 :size',
        'file' => ' :attribute 必須是 :size KB',
        'string' => ' :attribute 必須是 :size 個字符。',
        'array' => ' :attribute 必須是 :size 項。',
    ],
    'starts_with' => ' :attribute 必須以以下字符開始： :values',
    'string' => ' :attribute 必須是字符。',
    'timezone' => ' :attribute 必須是一個有效的時區。',
    'unique' => ' :attribute 已經被佔用。',
    'uploaded' => ' :attribute 上傳失敗。',
    'url' => ' :attribute 的格式無效。',
    'uuid' => ' :attribute 必須是一個有效的UUID。',

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
        'code' => '代碼',
        'current_password' => '當前密碼',
        'description' => '描述',
        'email' => '電子郵箱',
        'end_date' => '結束日期',
        'first_name' => '名字',
        'last_name' => '姓氏',
        'level' => '等級',
        'location' => '地點',
        'name' => '名字',
        'new_password' => '新密碼',
        'new_password_confirmation' => '確認新密碼',
        'order' => '排序',
        'region_id' => '地區',
        'password' => '密碼',
        'phone' => '電話',
        'qty' => '數量',
        'sex' => '性別',
        'ship_address' => '郵寄地址',
        'start_date' => '開始日期',
        'state' => '州/省',
        'time' => '時間',
        'time_zone' => '時區',
        'zipcode' => '郵編',
    ],

];
