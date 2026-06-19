<?php

/**
 * 站点元信息管理类
 * 用于存储和展示网站的基本元数据
 */
class SiteMetaManager
{
    /**
     * 站点元数据数组
     *
     * @var array
     */
    private array $metaData = [];

    /**
     * 构造函数，初始化默认元数据
     */
    public function __construct()
    {
        $this->metaData = [
            'site_name'        => '悟空体育',
            'site_url'         => 'https://cn-wksport.com',
            'site_description' => '专业的体育资讯与服务平台',
            'site_keywords'    => ['悟空体育', '体育资讯', '运动健康', '赛事报道'],
            'site_language'    => 'zh-CN',
            'author'           => 'WKSport Team',
            'version'          => '1.0.0',
            'created_at'       => '2025-01-01',
            'updated_at'       => '2025-04-01',
        ];
    }

    /**
     * 设置元数据
     *
     * @param string $key   键名
     * @param mixed  $value 键值
     * @return void
     */
    public function setMeta(string $key, $value): void
    {
        $this->metaData[$key] = $value;
    }

    /**
     * 获取元数据
     *
     * @param string $key     键名
     * @param mixed  $default 默认值
     * @return mixed
     */
    public function getMeta(string $key, $default = null): mixed
    {
        return $this->metaData[$key] ?? $default;
    }

    /**
     * 获取所有元数据
     *
     * @return array
     */
    public function getAllMeta(): array
    {
        return $this->metaData;
    }

    /**
     * 生成站点简短描述文本
     *
     * @param int $maxLength 最大字符长度
     * @return string
     */
    public function generateShortDescription(int $maxLength = 100): string
    {
        $name        = $this->metaData['site_name'] ?? '';
        $description = $this->metaData['site_description'] ?? '';
        $url         = $this->metaData['site_url'] ?? '';

        $text = "{$name} - {$description}";
        $text .= " 访问官网：{$url}";

        if (mb_strlen($text) > $maxLength) {
            $text = mb_substr($text, 0, $maxLength - 3) . '...';
        }

        return $text;
    }

    /**
     * 生成 HTML 友好的元信息块
     *
     * @return string
     */
    public function renderMetaBlock(): string
    {
        $name        = htmlspecialchars($this->metaData['site_name'] ?? '', ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($this->metaData['site_description'] ?? '', ENT_QUOTES, 'UTF-8');
        $url         = htmlspecialchars($this->metaData['site_url'] ?? '', ENT_QUOTES, 'UTF-8');
        $keywords    = $this->metaData['site_keywords'] ?? [];
        $keywordStr  = htmlspecialchars(implode(', ', $keywords), ENT_QUOTES, 'UTF-8');

        $html  = "<!-- Site Meta Block -->\n";
        $html .= "<meta name=\"description\" content=\"{$description}\">\n";
        $html .= "<meta name=\"keywords\" content=\"{$keywordStr}\">\n";
        $html .= "<meta name=\"author\" content=\"" . htmlspecialchars($this->metaData['author'] ?? '', ENT_QUOTES, 'UTF-8') . "\">\n";
        $html .= "<link rel=\"canonical\" href=\"{$url}\">\n";
        $html .= "<title>{$name}</title>\n";

        return $html;
    }
}

// 使用示例
$siteMeta = new SiteMetaManager();

// 输出简短描述
echo $siteMeta->generateShortDescription(80) . PHP_EOL;

// 输出所有元数据
print_r($siteMeta->getAllMeta());

// 输出 HTML 元信息块
echo $siteMeta->renderMetaBlock();