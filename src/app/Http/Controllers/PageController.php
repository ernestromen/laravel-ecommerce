<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use App\Events\testEvent;
use Illuminate\Support\Facades\Log;
use App\Services\DownloadTableData;

class PageController extends Controller
{
    protected $downloadTableData;

    public function __construct(testEvent $testEvent, DownloadTableData $downloadTableData)
    {
        $this->testEvent = $testEvent;
        $this->downloadTableData = $downloadTableData;
    }

    public function index()
    {
        return view("index");
    }

    public function register()
    {
        return view("register");
    }

    public function login()
    {
        return view("login");
    }


    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            // Now $user holds the authenticated user instance
            return redirect()->intended('/dashboard'); // Redirect to dashboard or any other desired location
        }

        // Authentication failed...
        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }


    public function dashboard()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view("dashboard", ['users' => $users, 'roles' => $roles, 'permissions' => $permissions]);
    }

    public function products()
    {
        $products = Product::all();
        return view("products", ["products" => $products]);
    }

    public function product($id)
    {
        $currentProduct = Product::find($id);
        $currentProductCategory = $currentProduct->category;
        return view("product", ["id" => $id, 'currentProduct' => $currentProduct, 'currentProductCategory' => $currentProductCategory]);
    }


    public function category($id)
    {
        $currentCategory = Category::find($id);

        return view("category", ["id" => $id, 'currentCategory' => $currentCategory]);
    }

    public function categories()
    {
        $categories = Category::all();
        return view("categories", ["categories" => $categories]);
    }

    public function downloadCsv($entityName)
    {
        return $this->downloadTableData->execute($entityName);
    }

    public function checkout()
    {
        return view("checkout");
    }
}
