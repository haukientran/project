# Project Package

Đây là một package quản lý dự án cho Laravel.

## Cài đặt

### 1️⃣ Thêm package vào dự án Laravel
Chạy lệnh sau để thêm package vào dự án Laravel mà không cần chỉnh sửa `composer.json`:

composer config repositories.project path packages/project
composer require project/project
composer dump-autoload