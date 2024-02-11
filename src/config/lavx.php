<?php

return [
    'site_font_size' => 'calc(12px + (24 - 12) * ((100vw - 320px) / (2560 - 320)))',
    'site_font' => '<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">',
    'site_font_family' => '"Noto Sans TC", "Helvetica Neue", Helvetica, Arial, "PingFang SC", "Hiragino Sans GB", "Heiti SC", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif',
    'site_background_color' => 'bg-gray-100',
    'site_logo' => 'https://picsum.photos/200',
    'super_admin_user_id' => env('SUPER_ADMIN_USER_ID', 0),
];