@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="post" class="login_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp"
                        placeholder="Enter Name">
                </div>


                <div class="form-group">
                    <label for="descriptionInput">Description</label>
                    <input name="description" type="text" class="form-control" id="descriptionInput"
                        aria-describedby="descriptionHelp" placeholder="Enter Description">
                </div>

                <button type="submit" class="btn btn-light text-dark">Create</button>
            </form>


        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
