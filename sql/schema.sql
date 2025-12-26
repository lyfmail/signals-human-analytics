-- Human Analytics v1
-- Optional database schema (NOT required for file-based logging)

CREATE TABLE human_visits (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    visited_at DATETIME NOT NULL,
    score TINYINT UNSIGNED NOT NULL,
    ip_hash CHAR(64) NOT NULL,

    INDEX idx_visited_at (visited_at),
    INDEX idx_score (score)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
