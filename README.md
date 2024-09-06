# Wncms

## 更新日誌

### v4.0.0 2024-08-03
#### 新增
- php requirement from 7.2+ to 8.2+
- laravel 10 -> 11
- jquery 3.2.1 -> 3.7.1
- update all composer dependency
- add database prefix to avoid conflict table name with mysql preserved keywords
#### 修復
- fix error when navigating panel/xxxx pages when cms is not installed
- fix php artisan migtate:fresh not working
- fix page controller error when $request-input is null
#### 優化
- merged old migrations and renamed migration files.
- rename modal database column external_image -> external_thumbnail
- updated default env file generator
- wncms_get_unique_slug() set default length to 8
- all // comment should leave a space after //. i.e. // Good and //Bad
- rewrite login logic in wncms.js and AuthenticatedSessionController
#### 移除
- remove vendor directory to make package smaller. Packages will be downloaded during installation
- removed gloabal function wn(), all replaced by wncms()
- removed global variable $wn, all replaced by $wncms
- removed analytic helpers to avoid performace issue. Replaced by third-party analytics tool
- remove wncms_get_theme_options() helper function. Use $website->get_options() in model

### v3.2.1 2024-05-19
#### 新增
- 新增數個旗次SVG
- 增加更多翻譯字段
- 後台各模組數據列表加入權限判斷
- 後台新增菜單判斷非管理員權限
- 預留1個代理Dashboard，供日後開發使用
#### 修復
- 修復部分大小寫錯誤
#### 優化
- common.table_status.blade.php 可以判斷更多狀態，新增自定功能

### v3.2.0 2024-03-14
#### 修復
- 修復新版本安裝時site_name為null報錯
#### 優化
- 更新安裝程序
- 使用api_token請求時，視爲登入

### v3.1.15 2024-03-12
#### 新增
- 新增Page模組的API
- 新增菜單模組API
- PostHelper getList() 支持 $isRandom 參數，可以獲取隨機文章
- Post模組新增 getTags ，獲取Tag列表，可傳入 $type參數
- WebsiteHelpr 新增排序功能
- 優化主題設定判斷可以分辨 0 和 未設定
- 新增一鍵複雜菜單功能
#### 修復
- 修復聯絡表單中current_url項被緩存問題
- 修復表單提交失敗時按鈕文字不顯示
#### 優化
- 計劃移除Post模組 getFirstCategory()，一律改為使用 getFirstTag('post_category')
- 優化手機版後台UI
- 生成主題檔案時，會自動替換starter字串為主題名稱，無需再手動修改
- 主題名稱按英文字母順序排列
- 文章搜索前，先判斷是否包括keyword
- 優化主題設定判斷，可以分辨 0 和 未設定
- 後台Tag顯示相關模組數量
- 所有Helper預設改為不使用分頁 $pageSize = 0

___
### v3.1.14 2023-12-17
#### 新增
- 批量複製文章功能

___
### v3.1.13 2023-12-12
#### 新增
- 模組列表的工具列，可以設定隱藏部分預設按鈕，例如 'hideToolbarStatusFiller' => true 可以隱藏狀態篩選下拉清單
- 聯絡表單增加提交後的js事件，可以針對成功及失敗分別設定
- 後台聯絡表單增加篩選功能
- 後台聯絡表單增加匯出 XLXS/CSV 功能
- 增加翻譯字段
#### 修復
- 修復假瀏覽量小數問題
#### 優化
- 調整部分後台UI

___
### v3.1.12 2023-12-11
#### 新增
- 系統設定中，加入上傳封面圖片時，自動轉換為webp
- 模組加入額外參數功能 ExtraAttribute，使用 getExtraAttribute() 和 saveExtraAttribute()
#### 修復
- 修復主題設定中，開關的說明有時候會重覆顯示

___
### v3.1.11 2023-12-08
#### 新增
- 更多翻譯字段
#### 修復
- 修復主題設定圖片若帶括號()未能顯示
#### 優化
- utm參數支持帶到著陸以外的其他頁面

___
### v3.1.10 2023-12-08
#### 新增
- 聯絡表單支持調整欄位順序
- 新增數項系統設定，設定超級管理員收件帳號
- 新增SMTP測試電郵功能
- 更新部分翻譯字段
- 聯絡表單現支持單選及多選
- 聯絡表單現支持檢查是否所有必須填寫項目都已填寫
#### 修復
- 修復手機版主題設定因網站名稱過長而跑版
- 修復部分模組未能批量刪除
- 修復文章回收時，未有更新狀態
#### 優化
- 更新預設Email模版，支持html

___
### v3.1.9 2023-12-06
#### 新增
- 新增Starter主題的 style.css 和 main.js
#### 修復
- 修復部分主題頁面的部件未能讀取
#### 優化
- 獲取文章時，如果指定了排除的分類ID，也會包括沒有分類的文章
- 更新表單系統，使用新的模版調用方法 $wncms->contact_form()->render()，直接生成表單結構
- 更新常見問題模組，增加更多欄位，可設定排序

___
### v3.1.8 2023-11-29
#### 新增
- 新增json-id結構

___
### v3.1.7 2023-11-21
#### 新增
- 優化後台手機版UI
- 所有上傳圖片模組，支緩更多圖片類型
- 新增一鍵匯入預設主題設定功能
#### 修復
- 修復文章上限少於分頁數量時，可能不顯示的問題
#### 優化
- 升級主題設定中的文本編輯器
- 更新翻譯字段

___
### v3.1.6 2023-11-17
#### 新增
- 文章批量指派到網站功能
- 新增點擊事件紀錄，屬性為[wncms-click]
- 新增顯示網站瀏覽量 (有別於文章瀏覽量，網站瀏覽量為全局，查看多少文章都只計算1次)
- 更多翻譯字段
- 系統設定新增瀏覽量，訪問量冷卻間隔，可以設定60分鐘算一次，或1440分鐘計算一次，自行輸入分鐘
- 廣告位加入多篩選條件

___
### v3.1.5 2023-11-16
#### 新增
- 菜單項目可以新增描述
- [開發者] 新增Wiget系統，用於建立Page template，增加可重用性
- [開發者] 初引入Sortable JS插件
- [開發者] 後台backend.blade.php加入可堆疊css位置，使用@push('foot_css')
- 更多翻譯字段
- 新增一鍵生成演示文章功能，方便開發
- [開發者] 新增第4個常用簡稱涵數gpto (getPageTemplateOption)，用於在page頁面中，獲取個別頁面參數
#### 修
- 修復Ajax聯絡表單返回訊息， 成功建立 改為 成功提交

#### 優化
- 頁面樊組option欄位由json類型改為text類型，防止自動排序
- 修改單頁加載順序， template > plain > static ，都沒有就跳轉主頁
- 修正以\#開頭的菜單連結未能正常跳轉錨點
- 修化手機版後台主題設定樣式
- [開發者] 大幅修改後台input.blade.php的判斷條件，為可視化編輯器作準備

___
### v3.1.4 2023-11-04
#### 新增
- [開發者] 模版中新增 $wncms 參數，等同於 $wn
- [開發者] 新增wncms()->paginateWithLimit() 方法，解決 paginate 不能與 limit同時使用的問題
- 更多翻譯字
- 緩存讚好數，每日使用排程任務更新到模組 like 欄位，可加速不需要實時讚好數的模組
- 更新 RecordViews 排程任務，可以紀錄任何 collection，例如visit, like, dislike
- [開發者] 新增 $wn->addVersion()，不需要再於模版中加上 '?v=' . $wn->getVersion()，新功能輸出時已包括 ?v=
- 引入 applicaion/ld+json 選項，可以Push到<head>中
#### 修復
- 修復3.1.3更新後，部分頁面未能讀取內容

#### 優化
- 預設主題<title>從「首頁」改為網站名稱
- 優化新增同名權限時的提示，不再是報錯，而是提示已有重覆項目
- [開發者] 重新命名前端視圖中的統計部分 get_view -> get, record_like -> like, record_view -> record

___
### v3.1.3 2023-10-31
#### 新增
- 更新後台菜單模組圖標
- 新增從文字中提取域名
- 廣告更換為可以設定永久廣告
- [開發者] 新增頁面模版功能，開發者可建立Blade檔案，用於頁面管理中，一鍵生成頁面
- 修復顏色表選項不顯示當前值
- 新增菜單Tag項目可以一鍵獲取多國語言功能，獲取後仍然可以自訂各語言顯示文字
- 新增更多預設廣告位置
- [開發者] 新增日期標示模塊 resources/views/common/table_date.blade.php ，根據日期與當前時間的距離，以不同顏色標示
- [開發者] 新判斷某連結是否與當前頁面連結相同，wncms()->isActiveUrl()
- 新增更多翻字段
- 新增文章排行榜功能 /psots/rank, /post/rank/{$period} ，可以按日週月年總排列
- [開發者] 新增WnMediaTraits，暫時只有1個功能，$this->addThumbnailFromRequest()，可以直接從request中上傳圖片
- [開發者] WnTgTraits 新增 getFirstTag() 功能，以獲取任何Model的第一個Tag
- [開發者] CacheHelper 新 get() 和 put() 功能
- [開發者] MenuHelper新增以輸出theme_page連結，與 external_link 差不多
- 新增一鍵複製廣告功
#### 修復
- [開發者] 修復更新Laravel版本後，Stub文件被覆蓋，導致模組生成器模版還原為設設
- 修復會員後面版錯誤
- 修復開啟緩存時，Tag分頁只顯示第1頁緩存問題
- 修復部分模組，管理員沒有初始權限問題
- 修復菜單項目更新後，排序可能會亂掉問題
#### 優化
- [開發者] 優代從字段中獲取連結功能，可選擇保留www， wncms()->getDomainFromString($string, $includePort = true, $preserveWWW = false)

___
### v3.1.2 2023-10-28
#### 新增
- 使用新的Redis緩存庫，可以清理個別標籤
- 新增後台一鍵清理緩存功能
- [開發者] 新增從String獲取域名+端口的方法，wncms()->getDomainFromString()
#### 優化
- [開發者] 整理代碼
- [開發者] Theme helper修改為不受緩存設定影響，即使關閉緩存，仍然會套用數據緩存的時間，預設為3600秒，以防閉閉緩存後，一個頁面請求幾十次數據庫只為了讀取主題設定
- [開發者] 更新CSRF路徑
- 修復主題設定中，Tinymce編輯器無效
- [開發者] TagHelper中，getList() 新增可以只獲取父級分Tag
- 更新文章AP
- 更新WNCMS安裝程序，簡化流程

___
### v3.1.1 2023-10-20
#### 新增
- 重製安裝流程，更簡單快速
- [開發者] Starter中的tagify欄位，改為可以輸入開關字搜索
- [開發者] 開發者可以自訂管理員控制台項目
- [開發者] 開發者可以自訂會員主頁項目
- 添加更多翻譯字段
#### 修復
- 修復部分模組未能清除標籤
#### 優化
- [開發者] 後台Sidebar Model部分重構，開發者可以自訂後台Model菜單順序，修改Model中的$menuPriority property
- [開發者] 更新 controller.model.stub
- 重寫註冊會員邏輯

___
### v3.0.8 2023-10-18
#### 新增
- [開發者] 更新Wncms core class，可以任意配額參數 $wn->anything = 'something';
- [開發者] 更新Wncms core class，更有效重用Helper Classes

___
### v3.0.7 2023-10-17
#### 新增
- 聯絡表單新增批量處理功能，可以批量設為已讀，批量設為未讀，批量設為已回覆
- 新增網站級的緩存
- 新增備用域名系統
- 部分後台頁面開始增加數據數量資訊，例如總數，及當前正在顯示第幾條數據
- 新增廣告模組
#### 優化
- 更新Ajax按鈕發送數據模式
- 優化系統設定緩存
- 升級tinymce編輯器，使用cloudflare CDN

___
### v3.0.6 2023-10-09
#### 新增
- 新增更多翻譯字段
- [開發者] 新增table_url Blade視圖
- [開發者] webphp 路遊新增演示模組
- [開發者] starter/index.bade.php 視圖新增再製按鈕
- [開發者] Tag模組新增 WnTagTraits 特徵，增 getAvailableTypes()，可以獲取分類法列表 ['post_tag', 'video_category', etc]

___
### v3.0.5 2023-10-07
#### 新增
- 檢查自定模組是否存在 (Custom{Model}Traits.php)

___
### v3.0.4 2023-10-07
#### 修復
- 修復部分模組小問題
#### 優化
- 優化後台UI

___
### v3.0.3 2023-10-06
#### 優化
- 更新文章模組，修復會員權限問題
- 移動Trait目錄到Ap目錄下

___
### v3.0.2 2023-09-30
#### 新增
- 新增Page類型 (純文字類型，由編輯器製作的模版，由主題提供的模版)

___
### 2.0.0 2021-07-28
- 全新版本發行! (相關更新紀錄已隱藏)

___
### 1.0.0 2019-03-01
- 首版本發行 (相關更新紀錄已隱藏)
