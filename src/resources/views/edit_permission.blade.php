@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">

            <form method="post" class="login_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="descriptionInput">Name</label>
                    <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="nameHelp"
                        placeholder="Enter Name" value="{{$permission->name}}">
                </div>
                <button type="submit" class="btn btn-light text-dark">Update</button>
            </form>


        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
