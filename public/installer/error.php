<?php
// Define translations
$translations = [
    'en' => [
        'install_instructions' => 'Before Installation',
        'description' => 'Please follow the instructions below to complete the installation. After completing the setup, refresh the page to proceed.',
        'enable_exec_function' => 'Method 1: Enable exec function',
        'enable_exec_desc' => 'The <code>exec</code> function is disabled on this server. Please enable it in your php.ini configuration.',
        'command_line_installation' => 'Method 2: Command Line Installation',
        'command_line_desc' => 'Run the following commands to install:',
        'copy_code' => 'Copy Code',
        'copied' => 'Copied',
    ],
    'zh_TW' => [
        'install_instructions' => '安裝前準備',
        'description' => '請按照以下說明完成安裝。完成設置後，刷新頁面以開始安裝。',
        'enable_exec_function' => '方法 1: 啟用 exec 函數',
        'enable_exec_desc' => '該伺服器上禁用了 <code>exec</code> 函數。請在你的 php.ini 配置中啟用它。',
        'command_line_installation' => '方法 2: 命令行安裝',
        'command_line_desc' => '運行以下命令來安裝：',
        'copy_code' => '複製代碼',
        'copied' => '已複製',
    ],
    'zh_CN' => [
        'install_instructions' => '安装前准备',
        'description' => '请按照以下说明完成安装。完成设置后，刷新页面以开始安装。',
        'enable_exec_function' => '方法 1: 启用 exec 函数',
        'enable_exec_desc' => '该服务器上禁用了 <code>exec</code> 函数。请在你的 php.ini 配置中启用它。',
        'command_line_installation' => '方法 2: 命令行安装',
        'command_line_desc' => '运行以下命令来安装：',
        'copy_code' => '复制代码',
        'copied' => '已复制',
    ],
];

// Current language (could be dynamically set based on user preference or browser settings)
$currentLang = isset($_GET['lang']) ? $_GET['lang'] : 'zh_TW';

// Function to get translation
function getTranslation($key)
{
    global $translations, $currentLang;
    return isset($translations[$currentLang][$key]) ? $translations[$currentLang][$key] : $key;
}

// Simulated function to get the list of locales (replace with actual data from your app)
function getLocaleList()
{
    return [
        'en' => ['native' => 'English'],
        'zh_TW' => ['native' => '繁體中文'],
        'zh_CN' => ['native' => '简体中文'],
    ];
}

// Simulated LaravelLocalization::getLocalizedURL function
function getLocalizedURL($locale)
{
    return '?lang=' . $locale; // Replace with your actual URL generation logic
}
?>

<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getTranslation('install_instructions'); ?></title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 500px;
            max-width: 90%;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
        }

        h1 {
            margin: 0 0 20px;
            text-align: center;
        }

        h2 {
            font-size: 20px;
            margin: 0 0 20px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }

        li {
            margin: 10px 0;
        }

        .description{
            text-align: center;
        }

        .card-1 code {
            background-color: #f1f1f1;
            color: #333;
            padding: 2px 4px;
            border-radius: 4px;
            font-family: monospace;
        }

        .code-block {
            background-color: #333;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            position: relative;
            overflow-x: auto;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
            text-align: left;
            display: inline-block;
            width: calc(100% - 20px);
        }

        .inline-code {
            background-color: #f1f1f1;
            color: #333;
            padding: 2px 4px;
            border-radius: 4px;
            font-family: monospace;
        }

        .copy-button {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .copy-button:focus {
            outline: none;
        }

        .copy-button.copied {
            background-color: #28a745;
        }

        .language-switcher-item-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .language-switcher-item-list li {
            display: inline-block;
            margin-right: 3px;
        }

        .language-switcher-item {
            text-decoration: none;
            padding: 3px 5px;
            border: 1px solid #007bff;
            border-radius: 3px;
            color: #007bff;
            font-size: 12px;
            transition: background-color 0.3s, color 0.3s;
        }

        .language-switcher-item:hover {
            background-color: #007bff;
            color: #fff;
        }

        .header {
            position: absolute;
            top: 0;
            right: 10px;

        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="language-switcher-wrapper">
            <ul class="language-switcher-item-list">
                <?php foreach (getLocaleList() as $key => $locale): ?>
                    <li>
                        <a class="language-switcher-item" href="<?php echo getLocalizedURL($key); ?>"><?php echo $locale['native']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="container">
        <h1><?php echo getTranslation('install_instructions'); ?></h1>
        <div class="card card-1">
            <h2><?php echo getTranslation('enable_exec_function'); ?></h2>
            <div>
                <?php echo getTranslation('enable_exec_desc'); ?>
            </div>
        </div>
        <div class="card card-2">
            <h2><?php echo getTranslation('command_line_installation'); ?></h2>
            <div class="code-block" id="code-block"><code>composer install<br>cp .env.example .env</code></div>
            <button class="copy-button" onclick="copyCode()"><?php echo getTranslation('copy_code'); ?></button>
        </div>
        <p class="description"><?php echo getTranslation('description'); ?></p>
    </div>

    <script>
        function copyCode() {
            const code = document.getElementById('code-block').innerText;
            navigator.clipboard.writeText(code).then(() => {
                const button = document.querySelector('.copy-button');
                button.textContent = '<?php echo getTranslation('copied'); ?>';
                button.classList.add('copied');
                setTimeout(() => {
                    button.textContent = '<?php echo getTranslation('copy_code'); ?>';
                    button.classList.remove('copied');
                }, 2000);
            });
        }
    </script>
</body>

</html>