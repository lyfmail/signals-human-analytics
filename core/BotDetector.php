<?php
namespace HumanAnalytics\Core;

class BotDetector
{
    protected array $botSignatures = [
        'bot', 'crawl', 'spider', 'slurp',
        'google', 'bing', 'yandex', 'duckduck',
        'baidu', 'facebook', 'twitter',
        'linkedin', 'whatsapp',
        'curl', 'wget', 'python', 'aiohttp',
        'headless', 'phantom', 'playwright',
        'selenium'
    ];

    /**
     * Determine if request is very likely non-human
     */
    public function isBot(): bool
    {
        $ua = strtolower(Utils::server('HTTP_USER_AGENT', ''));

        // Missing UA = almost always automation
        if ($ua === '') {
            return true;
        }

        foreach ($this->botSignatures as $signature) {
            if (strpos($ua, $signature) !== false) {
                return true;
            }
        }

        // Abnormal headers (very basic heuristic)
        if (!Utils::server('HTTP_ACCEPT_LANGUAGE')) {
            return true;
        }

        return false;
    }
}
