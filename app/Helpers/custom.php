<?php

/**
 * ----------------------------------------------------------------------------------------------------
 * ! Global functions
 * ----------------------------------------------------------------------------------------------------
 */

 
/**
* ----------------------------------------------------------------------------------------------------
* 演示功能描述
* ----------------------------------------------------------------------------------------------------
* @link https://wncms.cc
* @since 3.0.0
* @version 3.0.0
* 
* @param string|null $cacheKey 鍵名
*      預設值: -
*      描述: 用於指定要清除的緩存數據
*      命名規則: "Wncms_Path_To_Class_{方法名稱}_{$string1}_{$string2}_" . json_encode($array)
*      如果參數為array of string，使用ijson_encode將array轉string
*      最後一個參數後不需要底線
* 
* @param array|string|null $cacheTags 鍵標籤
*      預設值: null
*      描述: Redis緩存標籤
*      命名規則: 以相關Eloquent模組命名
*      例子: 用Model的plural作為tags，存放在array中，例如App\Models\Post 就使用 ['posts']，多個可以使用['websites', 'videos', 'posts']
* 
* @return boolean 成功清除 = true，不成功則 false
* @example wncms_model_word('user', 'create')
* TODO::待辦事項
* %緊急事項
* *備註
* ----------------------------------------------------------------------------------------------------
*/
if (!function_exists('wncms_get_example')) {
    function wncms_get_example($variable1 = 'wncms', $variable2 = 'test'): string
    {
        return $variable1 . " " . $variable2;
    }
}

//Put your code below
//====================================================

