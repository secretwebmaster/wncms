<?php
    /**
     * ----------------------------------------------------------------------------------------------------
     * 自定系統設定
     * ----------------------------------------------------------------------------------------------------
     * @link https://wncms.cc
     * @since 3.0.0
     * @version 3.1.15
     * 
     * @return array
     * 'tab_name' string
     * 'tab_content' nested array
     *      'type' 
     *      'name'
     * 參考系統設定 Setting Model 
     * ----------------------------------------------------------------------------------------------------
     */

    return [
        // [
        //     'tab_name' => 'tab_key', //在 resource/lang/{locale}/custom.php 加入翻譯 'tab_key_setting' => 'TAB名稱',
        //     'tab_content' => [
        //         ['type' => 'text', 'name' => 'open_ai_api_token'],
        //         ['type' => 'text', 'name' => 'request_user_agent'],
        //         ['type' => 'text', 'name' => 'request_timeout'],
        //         ['type' => 'select', 'name' => 'openai_completions_model','translate_option' => false, 'options' => [
        //                 'gpt-3.5-turbo',
        //                 'gpt-3.5-turbo-0125',
        //                 'gpt-3.5-turbo-1106',
        //                 'gpt-3.5-turbo-16k-0613',
        //                 'gpt-4-0125-preview',
        //                 'gpt-4-1106-preview',
        //             ]
        //         ],
        //         ['type' => 'text', 'name' => 'creativity'],
        //         ['type' => 'text', 'name' => 'variations'],
        //         ['type' => 'select', 'name' => 'content_length', 'options' => [
        //                 'long',
        //                 'medium',
        //                 'short',
        //             ]
        //         ],
        //         ['type' => 'text', 'name' => 'min_paragrapth_count'],
        //         ['type' => 'text', 'name' => 'max_paragrapth_count'],
        //         ['type' => 'select', 'name' => 'language', 'translate_option' => false, 'options'=> [
        //                 '繁體中文',
        //                 '廣東話',
        //                 '簡體中文',
        //                 '英文',
        //                 '日文',
        //                 '韓文',
        //                 '越南文',
        //                 '西班牙文',
        //             ]
        //         ],
        //         ['type' => 'text', 'name' => 'category_count'],
        //         ['type' => 'text', 'name' => 'tag_count'],
        //         ['type' => 'text', 'name' => 'max_subtitle_length'],
        //     ]
        // ],
    ];