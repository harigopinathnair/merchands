-- merchands/database/schema.sql

USE nqatsxqe_merchands2026;

CREATE TABLE IF NOT EXISTS leads (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  ref_id        VARCHAR(20) UNIQUE NOT NULL,
  name          VARCHAR(120) NOT NULL,
  phone         VARCHAR(20) NOT NULL,
  email         VARCHAR(180) NOT NULL,
  company       VARCHAR(120),
  shipment_type ENUM('sea','air','project','customs','other'),
  origin        VARCHAR(120),
  destination   VARCHAR(120),
  message       TEXT,
  utm_source    VARCHAR(60),
  utm_campaign  VARCHAR(60),
  ip_address    VARCHAR(45),
  status        ENUM('new','contacted','quoted','closed') DEFAULT 'new',
  notes         TEXT,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_status (status),
  INDEX idx_created (created_at),
  INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admin_users (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  username      VARCHAR(60) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  email         VARCHAR(180),
  full_name     VARCHAR(120),
  last_login    TIMESTAMP NULL,
  is_active     TINYINT(1) DEFAULT 1,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed admin user
-- Default password: changeme123
INSERT INTO admin_users (username, password_hash, full_name, email)
VALUES (
  'admin',
  '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
  'Admin User',
  'rankmonk@gmail.com'
);
