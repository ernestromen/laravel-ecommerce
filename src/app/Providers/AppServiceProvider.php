<?php
namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Services\DownloadTableData;
use App\Events\testEvent;
use App\Listeners\SendDownloadNotification;
use App\Listeners\StartCartListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind('DownloadTableData', function ($app) {
            return new DownloadTableData();
        });

        Event::listen(
            SendDownloadNotification::class,
        );
    }
    protected $listen = [
        testEvent::class => [
            SendOrderConfirmation::class,
        ],
    ];
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::id() != 1) {
                $cart = Cart::where('user_id', '=', Auth::id())->first();
                $cartProducts = $cart->products()->get();
                $cartItemCount = 0;

                foreach ($cartProducts as $product) {
                    $quantityOfProduct = $product->pivot->quantity;
                    $cartItemCount += $quantityOfProduct;
                }

                $view->with('cartItemCount', $cartItemCount);
            } else {
                $cartItemCount = 0;
                if (\Session::has('productInCart')) {
                    foreach (\Session::get('productInCart') as $product) {
                        $cartItemCount += $product['quantity'];

                    }
                }

                $view->with('cartItemCount', $cartItemCount);
            }
        });

        Event::listen(
            SendDownloadNotification::class,
        );

        Event::listen(
            StartCartListener::class,
        );
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
        Blade::directive('csvButton', function ($expression) {
            return "<?php echo '<form action=\"' . route('download_csv', ['entityName' => \App\Helpers\Helper::findEntityName($expression)]) . '\" method=\"post\" class=\"m-auto text-right\">' . csrf_field() . '<button class=\"btn btn-success rounded-circle mb-2\"> <i class=\"fa fa-download\" aria-hidden=\"true\" title=\"Download\"></i></button></form>'; ?>";
        });
    }
}