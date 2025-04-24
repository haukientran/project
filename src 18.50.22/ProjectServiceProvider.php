<?php
namespace Project;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ProjectServiceProvider extends ServiceProvider
{
 public function register()
 {
  // Đăng ký dịch vụ
  $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'project');
 }

 public function boot()
 {
  // Xuất bản các file cấu hình
  $this->publishes([
   __DIR__.'/../config/config.php' => config_path('project.php'),
  ]);

  // Tải routes
  Route::middleware('web')
      ->namespace('Project\Http\Controllers')
      ->group(__DIR__.'/../routes/web.php');

  // Tải migrations
  $this->loadMigrationsFrom(__DIR__.'/../migrations');
 }
}
