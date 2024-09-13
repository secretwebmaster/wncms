<?php

if (file_exists(__DIR__ . '/../../.env') && file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    header('Location: /install');
    exit;
}

session_start();

// Generate a random token and store it in the session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];

$translations = [
    'en' => [
        'title' => 'Server Preparation in Progress',
        'message' => 'The server is preparing for the installation. This may take a few moments, depending on the number of Composer packages being installed.',
        'warning' => 'Please do not close this window or navigate away.'
    ],
    'zh_TW' => [
        'title' => '伺服器準備中',
        'message' => '伺服器正在準備安裝。根據 Composer 套件的數量，這可能需要一些時間。',
        'warning' => '請不要關閉此窗口或離開此頁面。'
    ],
    'zh_CN' => [
        'title' => '服务器准备中',
        'message' => '服务器正在准备安装。根据 Composer 包的数量，这可能需要一些时间。',
        'warning' => '请不要关闭此窗口或离开此页面。'
    ],
];

require('language.php');

// Prepare the translation data for JavaScript
$translationsJson = json_encode($translations);

?>
<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getTranslation('title'); ?></title>
    <link rel="stylesheet" href="/installer/css/prepare.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="header">
        <div class="language-switcher-wrapper">
            <ul class="language-switcher-item-list">
                <?php foreach (getLocaleList() as $key => $locale): ?>
                    <li>
                        <a class="language-switcher-item" href="#" onclick="changeLanguage('<?php echo $key; ?>'); return false;"><?php echo $locale['native']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="message">
        <h1 id="title"><?php echo getTranslation('title'); ?></h1>
        <p id="message"><?php echo getTranslation('message'); ?></p>
        <p id="warning"><?php echo getTranslation('warning'); ?></p>

        <div id="progress-container">
            <div id="progress-bar"></div>
        </div>

        <div id="alert-message"></div>
        <div id="alert-suggestion"></div>
    </div>

    <script>
        const csrfToken = '<?php echo $csrfToken; ?>'; // Pass the CSRF token to JavaScript
        const translations = <?php echo $translationsJson; ?>; // Pass the translations to JavaScript
        let progressBar = document.getElementById('progress-bar');
        let interval;
        
        function simulateProgress() {
            let width = 0;
            const maxWidth = 99; // Set to 95% so it never reaches 100% normally
            const incrementFactor = 0.05; // Larger increments initially

            interval = setInterval(() => {
                if (width >= maxWidth) {
                    clearInterval(interval);
                } else {
                    // Calculate the progress incrementally with a diminishing increase
                    let increment = Math.min(maxWidth - width, incrementFactor * (1 - (width / maxWidth)) + Math.random() * 2);
                    width += increment;
                    if (width > maxWidth) width = maxWidth; // Cap the width at maxWidth
                    progressBar.style.width = width + '%';
                }
            }, 200);
        }

        function changeLanguage(lang) {
            document.getElementById('title').textContent = translations[lang].title;
            document.getElementById('message').textContent = translations[lang].message;
            document.getElementById('warning').textContent = translations[lang].warning;
        }

        simulateProgress();

        fetch('/installer/merge-composer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken // Send the CSRF token in the request header
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log(data.message);
                    clearInterval(interval);
                    progressBar.style.width = '100%';
                    location.href = '/install';
                } else {
                    console.error('Error:', data.message);
                    document.getElementById('alert-message').textContent = data.message;
                    document.getElementById('alert-message').style.display = 'block';
                    document.getElementById('progress-bar').style.backgroundColor = "red";
                    clearInterval(interval);

                    if(data.suggestion) {
                        document.getElementById('alert-suggestion').textContent = data.suggestion;
                        document.getElementById('alert-suggestion').style.display = 'block';
                    }
                }

                // Log the output if it is defined
                if (data.output) {
                    console.log('Output:', data.output);
                }
            })
            .catch(error => console.error('Fetch error:', error));
    </script>
</body>

</html>
