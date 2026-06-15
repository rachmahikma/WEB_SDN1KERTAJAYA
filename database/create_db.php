<?php
$mysqli = new mysqli('localhost', 'root', '');
if ($mysqli->connect_error) {
    echo 'ERROR: ' . $mysqli->connect_error . PHP_EOL;
    exit(1);
}

if (! $mysqli->query('CREATE DATABASE IF NOT EXISTS `sdn1kertajaya` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;')) {
    echo 'ERROR1: ' . $mysqli->error . PHP_EOL;
    exit(1);
}

if (! $mysqli->select_db('sdn1kertajaya')) {
    echo 'ERROR2: ' . $mysqli->error . PHP_EOL;
    exit(1);
}

$queries = [
    'CREATE TABLE IF NOT EXISTS `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(50) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `role` ENUM("admin","guru","kepala","siswa") NOT NULL,
        `name` VARCHAR(100) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',
    'CREATE TABLE IF NOT EXISTS `students` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `nisn` VARCHAR(20) NOT NULL UNIQUE,
        `name` VARCHAR(100) NOT NULL,
        `username` VARCHAR(100) DEFAULT NULL UNIQUE,
        `class` VARCHAR(50) NOT NULL,
        `status` VARCHAR(50) DEFAULT "Aktif",
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',
    'CREATE TABLE IF NOT EXISTS `teachers` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `nik` VARCHAR(20) NOT NULL UNIQUE,
        `name` VARCHAR(100) NOT NULL,
        `subject` VARCHAR(100) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',
    'CREATE TABLE IF NOT EXISTS `employees` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `nik` VARCHAR(20) NOT NULL UNIQUE,
        `name` VARCHAR(100) NOT NULL,
        `position` VARCHAR(100) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',
    'CREATE TABLE IF NOT EXISTS `grades` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `student_id` INT NOT NULL,
        `subject` VARCHAR(100) NOT NULL,
        `score` TINYINT NOT NULL,
        `attendance_score` TINYINT DEFAULT 0,
        `attitude_score` TINYINT DEFAULT 0,
        `extracurricular_score` TINYINT DEFAULT 0,
        `final_score` TINYINT DEFAULT 0,
        `semester` VARCHAR(20) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',
    'CREATE TABLE IF NOT EXISTS `attendance` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `student_id` INT NOT NULL,
        `date` DATE NOT NULL,
        `status` ENUM("Hadir","Izin","Sakit","Alpha") NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',
    'CREATE TABLE IF NOT EXISTS `achievements` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `student_id` INT NOT NULL,
        `title` VARCHAR(150) NOT NULL,
        `category` VARCHAR(100) NOT NULL,
        `description` TEXT,
        `date` DATE NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;'
];

foreach ($queries as $query) {
    if (! $mysqli->query($query)) {
        echo 'ERROR3: ' . $mysqli->error . PHP_EOL;
        exit(1);
    }
}

if (! $mysqli->query('INSERT IGNORE INTO `users` (`username`,`password`,`role`,`name`) VALUES ("admin","admin123","admin","Administrator"),("guru","guru123","guru","Guru Pengajar"),("kepala","kepala123","kepala","Kepala Sekolah"),("siswa","siswa123","siswa","Siswa")')) {
    echo 'ERROR4: ' . $mysqli->error . PHP_EOL;
    exit(1);
}

echo 'OK' . PHP_EOL;
