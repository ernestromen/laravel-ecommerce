@include('includes.header')

<div class="cotnainer">
    <h2 class="text-center my-5">Categories</h2>
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            @csvButton($categories)
            <table class="table border">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        @role('admin')
                        <th></th>
                        <th></th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="text-center">
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>{{$category->updated_at}}</td>
                            @role('admin')
                            <td> <a href="{{route('edit_category', ["id" => $category->id])}}"
                                    class="btn btn-success rounded-circle">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="delete category"></i>
                                </a>
                            </td>
                            <td>
                                <form action={{route('delete_category', ['id' => $category])}} method="post" class="m-auto">
                                    {{csrf_field()}}
                                    <button class="btn btn-danger rounded-circle mb-2">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete category">

                                        </i></button>
                                </form>
                            </td> @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-2">

        </div>
    </div>
</div>
@include('includes.footer')
