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
                        placeholder="Enter Name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="EmailInput">Email</label>
                    <input name="email" type="text" class="form-control" id="emailInput" aria-describedby="emailnHelp"
                        placeholder="Enter Email" value="{{$user->email}}">
                </div>

                <button type="submit" class="btn btn-light text-dark">Update</button>
            </form>


        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
