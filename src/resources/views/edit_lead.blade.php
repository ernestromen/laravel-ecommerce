@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">

            <form method="post" class="login_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nameInput">First name</label>
                    <input name="firstname" type="text" class="form-control" id="firstNameInput" aria-describedby="firstNameHelp"
                        placeholder="Enter Name" value="{{$lead->firstname}}">
                </div>


                <div class="form-group">
                    <label for="descriptionInput">Last name</label>
                    <input name="lastname" type="text" class="form-control" id="descriptionInput"
                        aria-describedby="descriptionHelp" placeholder="Enter Description" value="{{$lead->lastname}}">
                </div>

                <div class="form-group">
                    <label for="priceInput">email</label>
                    <input name="email" type="text" class="form-control" id="emailInput" aria-describedby="pricenHelp"
                        placeholder="Enter Price" value="{{$lead->email}}">
                </div>

                <div class="form-group">
                    <label for="priceInput">phone</label>
                    <input name="phone" type="text" class="form-control" id="priceInput" aria-describedby="pricenHelp"
                        placeholder="Enter Price" value="{{$lead->phone}}">
                </div>
                <div class="form-group">
                    <label for="skuInput">message</label>
                    <input name="message" type="text" class="form-control" id="skuInput" aria-describedby="skuHelp"
                        placeholder="Enter SKU" value="{{$lead->message}}">
                </div>



                <button type="submit" class="btn btn-light text-dark">Update</button>
            </form>


        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
