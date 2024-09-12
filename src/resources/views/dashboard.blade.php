@include('includes.header')

<h1 class="text-center text-black my-5">dashboard</h1>
<div class="cotnainer text-center">
    <h2 class="text-center my-5">Users</h2>
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6">
            @csvButton($users)
            <table class="table border">
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
                            <td>{{$user->getRoleNamesAttribute()}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-6"> <a href="{{route('edit_user', ["id" => $user->id])}}"
                                            class="btn btn-success rounded-circle"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true" title="delete category">
                                            </i></a>
                                    </div>

                                    <div class="col-6">
                                        <form action={{route('delete_user', ['id' => $user])}} method="post" class="m-auto">
                                            {{csrf_field()}}
                                            <button class="btn btn-danger rounded-circle mb-2">
                                                <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete model">
                                                </i></button>
                                        </form>
                                    </div>
                                </div>


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
        <div class="col-3"></div>
        <div class="col-6">
            @csvButton($roles)
            <table class="table border">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="text-center">
                            <th scope="row">{{$role->id}}</th>
                            <td>{{$role->name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>{{$role->updated_at}}</td>

                            <td>
                                <div class="row">
                                    <div class="col-6"> <a href="{{route('edit_role', ["id" => $role->id])}}"
                                            class="btn btn-success rounded-circle"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true" title="delete category">
                                            </i></a>
                                    </div>

                                    <div class="col-6">
                                        <form action={{route('delete_role', ['id' => $role])}} method="post" class="m-auto">
                                            {{csrf_field()}}
                                            <button class="btn btn-danger rounded-circle mb-2">
                                                <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete model">
                                                </i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-3"></div>

    </div>
    <h4 class="text-center my-5">Permissions</h4>
    <div class="row mt-5">
        <div class="col-3"></div>
        <div class="col-6">
            @csvButton($permissions)
            <table class="table border">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr class="text-center">
                            <th scope="row">{{$permission->id}}</th>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->created_at}}</td>
                            <td>{{$permission->updated_at}}</td>

                            <td>
                                <div class="row">
                                    <div class="col-6"> <a href="{{route('edit_permission', ["id" => $permission->id])}}"
                                            class="btn btn-success rounded-circle"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true" title="delete permission">
                                            </i></a>
                                    </div>

                                    <div class="col-6">

                                        <form action={{route('delete_permission', ['id' => $permission])}} method="post">
                                            {{csrf_field()}}
                                            <button class="btn btn-danger rounded-circle mb-2">
                                                <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete model">
                                                </i></button>
                                        </form>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-3"></div>

    </div>
</div>
@include('includes.footer')
