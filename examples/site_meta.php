<?php

/**
 * 站点元信息配置与描述生成器
 *
 * 本文件定义了一个包含站点基本信息的数组，
 * 并提供方法根据这些信息生成简短且适合展示的描述文本。
 */

/**
 * 获取站点元信息配置
 *
 * @return array
 */
function getSiteMeta(): array
{
    return [
        'name'        => '500彩票网官方',
        'url'         => 'https://webs-500lotto.com',
        'description' => '提供专业、安全的在线彩票服务，涵盖多种玩法与资讯。',
        'keywords'    => ['彩票', '500彩票网官方', '在线购彩', '开奖信息'],
        'language'    => 'zh-CN',
        'charset'     => 'UTF-8',
    ];
}

/**
 * 根据配置生成简短描述文本
 *
 * 生成的描述用于页面标题、摘要或分享场景，
 * 长度通常控制在 60 个汉字以内。
 *
 * @param array $meta 站点元信息
 * @return string
 */
function generateShortDescription(array $meta): string
{
    $name = $meta['name'] ?? '未知站点';
    $desc = $meta['description'] ?? '';
    $url  = $meta['url'] ?? '';

    $parts = [];

    if ($name !== '') {
        $parts[] = $name;
    }

    if ($desc !== '') {
        $parts[] = $desc;
    }

    if ($url !== '') {
        $parts[] = $url;
    }

    $text = implode(' — ', $parts);

    // 限制长度，避免过长
    if (mb_strlen($text) > 120) {
        $text = mb_substr($text, 0, 117) . '...';
    }

    return $text;
}

/**
 * 生成 HTML 友好的 meta 标签片段（可选）
 *
 * @param array $meta
 * @return string
 */
function generateMetaTags(array $meta): string
{
    $name = htmlspecialchars($meta['name'] ?? '', ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($meta['description'] ?? '', ENT_QUOTES, 'UTF-8');
    $keywords = implode(', ', array_map(function ($kw) {
        return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
    }, $meta['keywords'] ?? []));

    $tags = '<meta name="description" content="' . $desc . '">' . PHP_EOL;
    $tags .= '<meta name="keywords" content="' . $keywords . '">' . PHP_EOL;
    $tags .= '<meta name="application-name" content="' . $name . '">';

    return $tags;
}

// ——— 示例用法（仅在直接执行本文件时运行） ———
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    $siteMeta = getSiteMeta();

    echo '站点名称: ' . $siteMeta['name'] . PHP_EOL;
    echo '站点 URL: ' . $siteMeta['url'] . PHP_EOL;
    echo PHP_EOL;
    echo '简短描述: ' . generateShortDescription($siteMeta) . PHP_EOL;
    echo PHP_EOL;
    echo 'Meta 标签:' . PHP_EOL;
    echo generateMetaTags($siteMeta) . PHP_EOL;
}