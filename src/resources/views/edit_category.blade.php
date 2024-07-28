@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">

            <form method="post" class="login_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp"
                        placeholder="Enter Name" value="{{$category->name}}">
                </div>


                <div class="form-group">
                    <label for="descriptionInput">Description</label>
                    <input name="description" type="text" class="form-control" id="descriptionInput"
                        aria-describedby="descriptionHelp" placeholder="Enter Description"
                        value="{{$category->description}}">
                </div>

                <button type="submit" class="btn btn-light text-dark">Update</button>
            </form>



        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
