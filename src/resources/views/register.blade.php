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


        <button type="submit" class="btn btn-light text-dark">Register</button>
      </form>
      <a href="{{route('login')}}">Already have a user?</a>


    </div>
    <div class="col-4"></div>

  </div>
</div>

@include('includes.footer')
