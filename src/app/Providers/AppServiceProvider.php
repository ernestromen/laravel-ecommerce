<?php
namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Services\DownloadTableData;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('DownloadTableData', function ($app) {
            return new DownloadTableData();
        });
    }
    public function boot(): void
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
        }
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });
        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });
    }
}