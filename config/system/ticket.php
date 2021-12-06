<?php 

return [

    'status' => [
        'pending'                       =>  1,
        'completed'                     =>  2,
        'error'                         =>  3,
    ],

    'status_text' => [
        1 => 'Processing',
        2 => 'Completed',
        3 => 'Failed'
    ],

    'stage' => [
        'audio_pre_process'             =>  1,
        'audio_pre_processed'           =>  2,
        'audio_peri_process'            =>  3,
        'audio_peri_processed'          =>  4,
        'audio_post_process'            =>  5,
        'audio_post_processed'          =>  6,
        'completed'                     =>  7,
    ],

    'stage_text' => [
        1 => 'Detecting audio language',
        2 => 'Processing audio transcript',
        3 => 'Spotting keyword and translating',
        4 => 'Generating audio topic and summarization',
        5 => 'Creating ticket and customer record',
        6 => 'Analysing sentiment and name entity',
        7 => 'Call data processed',
    ],

    'language_code' => [
        'eng' => 'en-US',
        'deu' => 'de',
        'fre' => 'fr',
        'spa' => 'es',
        'chi' => 'zh-CN',
        'rus' => 'ru',
    ], 

    'language_text' => [
        'eng' => 'English',
        'deu' => 'Germany',
        'fre' => 'French',
        'spa' => 'Spanish',
        'chi' => 'Chinese',
        'rus' => 'Russian',
    ]

];