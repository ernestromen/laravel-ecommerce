@include('includes.header')

<div class="container-fluid">
  <div class="row mt-md-5 mt-4">
    <div class="col-xl-4 col-lg-3 col-md-2 col-1 d-sm-block d-none"></div>
    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col-12">

      @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
      </ul>
      </div>
    @endif

      <form method="post" class="login_form">
        {{csrf_field()}}
        <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Enter name">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Enter email">
        </div>


        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>


        <button type="submit" class="btn btn-light text-dark w-100">Register</button>
      </form>
      <a href="{{route('login')}}">Already have a user?</a>


    </div>
    <div class="col-xl-4 col-lg-3 col-md-2 col-1 d-sm-block d-none"></div>

  </div>
</div>

@include('includes.footer')
