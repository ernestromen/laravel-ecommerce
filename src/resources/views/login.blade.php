@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5 mb-5">
        <div class="col-xl-4 col-lg-3 col-md-1 col-1 d-md-block d-none"></div>
        <div class="col-xl-4 col-lg-6 col-md-10 col-12">

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


                <button type="submit" class="btn btn-light text-dark w-100">Login</button>
            </form>


        </div>
        <div class="col-xl-4 col-lg-3 col-md-1 col-1 d-md-block d-none"></div>

    </div>
</div>

@include('includes.footer')
