@include('includes.header')
<style>

</style>
<main>
    <section class="user-container">
        <div class="user-info">
            <!-- <img src="user-avatar.jpg" alt="User Avatar" class="avatar"> -->
            <img class="mt-3"
                src="{{ $user->image ? asset('images/' . $user->image) : 'https://via.placeholder.com/400x300' }}"
                alt="Product Image" class="product-img">
            <form action="{{ route('products_store', ["id" => $user->id]) }}" method="post"
                enctype="multipart/form-data" class="mt-2">
                @csrf
                <label for="fileInput" id="saveLabel">
                    LABEL:
                </label>
                <input name="imageUrl" id="fileInput" type="file" />
                <br>
                <button id="saveImageBtn" type="submit" class="btn btn-success" value="save image">
                    <i class=" fa-1x fa fa-save" style="cursor:pointer"></i> Save image

                </button>
            </form>
            <h2>{{ $user->name }}</h2>
            <p>Email: {{ $user->email }}</p>
            <p>Joined: {{ $user->created_at->format('F j, Y') }}</p>
        </div>
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
        <!-- <div class="user-actions">
            <a href="/edit-profile" class="button">Edit Profile</a>
            <a href="/logout" class="button">Logout</a>
        </div> -->
    </section>
</main>
@include('includes.footer')