<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Category;
use App\Models\Product;
use League\Csv\Writer;
use Response;
use Illuminate\Support\Facades\Schema;
use App\Services\DownloadTableData;

class PageController extends Controller
{
    protected $downloadTableData;

    public function __construct(DownloadTableData $downloadTableData)
    {
        $this->downloadTableData = $downloadTableData;
    }

    public function index()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $userName = Auth::user() ? Auth::user()->name : '';
        return view("index", ["userName" => $userName, "currentUser" => $currentUser]);
    }

    public function register()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $user = Auth::user() ? Auth::user()->name : "";
        return view("register", ["user" => $user, "currentUser" => $currentUser]);
    }

    public function login()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $user = Auth::user() ? Auth::user()->name : "";
        return view("login", ["user" => $user, "currentUser" => $currentUser]);
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
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view("dashboard", ["currentUser" => $currentUser, 'users' => $users, 'roles' => $roles, 'permissions' => $permissions]);
    }

    public function products()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";

        $products = Product::all();
        return view("products", ["products" => $products, "currentUser" => $currentUser]);
    }

    public function product($id)
    {
        $currentProduct = Product::find($id);
        $currentProductCategory = $currentProduct->category;
        $currentUser = Auth::user() ? Auth::user()->name : "";

        return view("product", ["id" => $id, "currentUser" => $currentUser, 'currentProduct' => $currentProduct, 'currentProductCategory' => $currentProductCategory]);
    }


    public function category($id)
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $currentCategory = Category::find($id);

        return view("category", ["id" => $id, "currentUser" => $currentUser, 'currentCategory' => $currentCategory]);
    }

    public function categories()
    {
        $currentUser = Auth::user() ? Auth::user()->name : "";
        $categories = Category::all();
        return view("categories", ["categories" => $categories, "currentUser" => $currentUser]);
    }

    public function downloadCsv($entityName)
    {
        return $this->downloadTableData->execute($entityName);
    }
}
