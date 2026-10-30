# Chaeri-e Database Structure & Deployment SQL

This document contains the complete SQL schema and table structures for the **Chaeri-e** application. When deploying to production (such as **cPanel, phpMyAdmin, MySQL, MariaDB, Railway, VPS, or cloud hosting**), you can copy and paste the SQL code directly into your SQL tab or CLI.

---

## Table of Contents
1. [Quick Copy-Paste: Complete MySQL/MariaDB Schema](#1-quick-copy-paste-complete-mysqlmariadb-schema)
2. [Core Business Tables Only (Orders & Inquiries)](#2-core-business-tables-only)
3. [Table Reference & Field Descriptions](#3-table-reference--field-descriptions)
   - [website_inquiries](#website_inquiries)
   - [orders](#orders)
   - [users & auth](#users--authentication)
   - [sessions & cache](#sessions--cache)
   - [queue jobs](#queue--jobs)
4. [Deployment Instructions (phpMyAdmin / cPanel / CLI)](#4-deployment-instructions)
5. [Production .env Database Configuration](#5-production-env-configuration)

---

## 1. Quick Copy-Paste: Complete MySQL/MariaDB Schema

Run this SQL script to create all tables (application tables + Laravel framework tables) with UTF-8 support:

```sql
-- ============================================================
-- CHAERI-E MATCHA ATELIER & DIGITAL STUDIO
-- COMPLETE DATABASE DUMP (MySQL / MariaDB / phpMyAdmin)
-- Character Set: utf8mb4 / Collation: utf8mb4_unicode_ci
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ------------------------------------------------------------
-- 1. Table structure for: website_inquiries
--    Stores guest submissions for custom website creation
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `website_inquiries` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `business_name` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) DEFAULT NULL,
  `wa_number` VARCHAR(255) NOT NULL,
  `message` TEXT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_website_inquiries_status` (`status`),
  KEY `idx_website_inquiries_wa` (`wa_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 2. Table structure for: orders
--    Stores customer matcha orders & customizations
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` VARCHAR(255) NOT NULL,
  `customer_name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) DEFAULT 'Walk-in',
  `dine_option` VARCHAR(50) NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `items` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `subtotal` DECIMAL(12,2) NOT NULL DEFAULT '0.00',
  `tax` DECIMAL(12,2) NOT NULL DEFAULT '0.00',
  `total_amount` DECIMAL(12,2) NOT NULL DEFAULT '0.00',
  `status` VARCHAR(50) NOT NULL DEFAULT 'PAID',
  `ordered_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`),
  KEY `idx_orders_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3. Table structure for: users
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 4. Table structure for: password_reset_tokens
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 5. Table structure for: sessions
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT UNSIGNED DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6. Table structure for: cache
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7. Table structure for: cache_locks
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 8. Table structure for: jobs
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 9. Table structure for: job_batches
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT DEFAULT NULL,
  `cancelled_at` INT DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 10. Table structure for: failed_jobs
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 11. Table structure for: migrations
--     Marks all Laravel migrations as already executed
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_14_113815_create_orders_table', 1),
(5, '2026_10_30_175324_create_website_inquiries_table', 1);

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
```

---

## 2. Core Business Tables Only

If you only need the application tables (`website_inquiries` and `orders`):

```sql
-- 1. Website Inquiry Form Submissions
CREATE TABLE IF NOT EXISTS `website_inquiries` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `business_name` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) DEFAULT NULL,
  `wa_number` VARCHAR(255) NOT NULL,
  `message` TEXT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_website_inquiries_status` (`status`),
  KEY `idx_website_inquiries_wa` (`wa_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Chaeri-e Matcha Orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` VARCHAR(255) NOT NULL,
  `customer_name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) DEFAULT 'Walk-in',
  `dine_option` VARCHAR(50) NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `items` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `subtotal` DECIMAL(12,2) NOT NULL DEFAULT '0.00',
  `tax` DECIMAL(12,2) NOT NULL DEFAULT '0.00',
  `total_amount` DECIMAL(12,2) NOT NULL DEFAULT '0.00',
  `status` VARCHAR(50) NOT NULL DEFAULT 'PAID',
  `ordered_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 3. Table Reference & Field Descriptions

### `website_inquiries`
Captures guest inquiries requesting custom website creation.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | `BIGINT UNSIGNED` | No | Auto Increment | Primary Key |
| `name` | `VARCHAR(255)` | No | - | Guest / Client full name |
| `business_name` | `VARCHAR(255)` | Yes | `NULL` | Business or brand name |
| `email` | `VARCHAR(255)` | No | - | Guest contact email |
| `phone` | `VARCHAR(255)` | Yes | `NULL` | Phone number |
| `wa_number` | `VARCHAR(255)` | No | - | WhatsApp number for direct follow-up |
| `message` | `TEXT` | Yes | `NULL` | Details about project / preferred features |
| `status` | `VARCHAR(50)` | No | `'pending'` | Inquiry status (`pending`, `contacted`, `completed`) |
| `created_at` | `TIMESTAMP` | Yes | `CURRENT_TIMESTAMP` | Submission timestamp |
| `updated_at` | `TIMESTAMP` | Yes | `CURRENT_TIMESTAMP` | Last updated timestamp |

### `orders`
Stores customer orders placed through the matcha ordering catalog.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | `BIGINT UNSIGNED` | No | Auto Increment | Primary Key |
| `order_id` | `VARCHAR(255)` | No | Unique | Order code (e.g., `ORD-001`) |
| `customer_name` | `VARCHAR(255)` | No | - | Customer name |
| `phone` | `VARCHAR(255)` | Yes | `'Walk-in'` | Customer phone number |
| `dine_option` | `VARCHAR(50)` | No | - | `Dine In` or `Take Away` |
| `notes` | `TEXT` | Yes | `NULL` | Special prep instructions |
| `items` | `LONGTEXT / JSON`| No | - | JSON array of cart items & customizations |
| `subtotal` | `DECIMAL(12,2)` | No | `0.00` | Subtotal amount in IDR |
| `tax` | `DECIMAL(12,2)` | No | `0.00` | Tax amount (PB1 10%) |
| `total_amount` | `DECIMAL(12,2)` | No | `0.00` | Final total amount in IDR |
| `status` | `VARCHAR(50)` | No | `'PAID'` | Order payment status |
| `ordered_at` | `TIMESTAMP` | Yes | `NULL` | Time order was placed |
| `created_at` | `TIMESTAMP` | Yes | `CURRENT_TIMESTAMP` | Record creation timestamp |
| `updated_at` | `TIMESTAMP` | Yes | `CURRENT_TIMESTAMP` | Record update timestamp |

---

## 4. Deployment Instructions

### Option A: Using phpMyAdmin / cPanel
1. Open **cPanel** and go to **phpMyAdmin**.
2. Select your target database from the left sidebar (or create a new database first in **cPanel > MySQL Databases**).
3. Click the **SQL** tab at the top.
4. Copy the SQL code from [Section 1](#1-quick-copy-paste-complete-mysqlmariadb-schema) above and paste it into the query box.
5. Click **Go** / **Execute**.

### Option B: Using MySQL Command Line (CLI / SSH)
If you have SSH terminal access to your server:
```bash
mysql -u your_db_user -p your_db_name < database_dump.sql
```
*(Or paste the script directly into the interactive `mysql>` prompt).*

### Option C: Using Laravel Artisan (Alternative)
If your production server supports terminal commands, you can simply run:
```bash
php artisan migrate --force
```

---

## 5. Production .env Configuration

Update your `.env` file on your production server to connect to your MySQL database:

```ini
APP_NAME="Chaeri-e Matcha"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

Once updated, cache the configuration for optimal speed:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

