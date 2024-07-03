@include('includes.header')

<h1 class="text-center text-black my-5">dashboard</h1>
<div class="cotnainer">
    <h2 class="text-center my-5">Users</h2>
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role_id</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_id}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                <button class="btn btn-success">update</button>
                                <button class="btn btn-danger">delete</button>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-3">

        </div>

    </div>
    <h3 class="text-center my-5">Roles</h3>
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="text-center">
                            <th scope="row">{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>
                                <button class="btn btn-success">update</button>
                                <button class="btn btn-danger">delete</button>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4"></div>

    </div>
    <h4 class="text-center my-5">Permissions</h4>
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr class="text-center">
                            <th scope="row">{{$permission->id}}</th>
                            <td>{{$permission->name}}</td>
                            <td>
                                <button class="btn btn-success">update</button>
                                <button class="btn btn-danger">delete</button>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4"></div>

    </div>
</div>
@include('includes.footer')
