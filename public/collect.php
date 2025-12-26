<?php
/**
 * Signals — Human Signal Collection Endpoint
 * Accepts POSTed interaction signals
 */

declare(strict_types=1);

require_once __DIR__ . '/../core/BotDetector.php';
require_once __DIR__ . '/../core/HumanScore.php';
require_once __DIR__ . '/../core/Logger.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'method_not_allowed']);
    exit;
}

// Reject obvious bots early
if (BotDetector::isBot($_SERVER)) {
    echo json_encode(['status' => 'ignored']);
    exit;
}

// Read JSON payload
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    echo json_encode(['status' => 'invalid_payload']);
    exit;
}

// Score human confidence
$score = HumanScore::calculate($data);

// Only verified humans are logged
if ($score >= HumanScore::THRESHOLD) {
    Logger::logHumanVisit($score);
    echo json_encode(['status' => 'human_verified']);
    exit;
}

// Low-confidence traffic is ignored
echo json_encode(['status' => 'unverified']);
