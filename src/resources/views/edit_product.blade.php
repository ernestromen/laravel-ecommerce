@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">

            <form method="post" class="login_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email">
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                </div>


                <button type="submit" class="btn btn-light text-dark">Login</button>
            </form>


        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
