@include('includes.header')

<div class="cotnainer">
    <h2 class="text-center my-5">Categories</h2>
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8">
            @csvButton($categories)
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>

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
