@include('includes.header')

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">

            <form method="post" class="login_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input name="name" type="text" class="form-control" id="nameInput"
                        aria-describedby="nameHelp" placeholder="Enter Name" value="{{$product->name}}">
                </div>


                <div class="form-group">
                    <label for="descriptionInput">Description</label>
                    <input name="description" type="text" class="form-control" id="descriptionInput"
                        aria-describedby="descriptionHelp" placeholder="Enter Description" value="{{$product->description}}">
                </div>

                <div class="form-group">
                    <label for="priceInput">Price</label>
                    <input name="price" type="text" class="form-control" id="priceInput"
                        aria-describedby="pricenHelp" placeholder="Enter Price" value="{{$product->price}}">
                </div>


                <div class="form-group">
                    <label for="skuInput">SKU</label>
                    <input name="SKU" type="text" class="form-control" id="skuInput"
                        aria-describedby="skuHelp" placeholder="Enter SKU" value="{{$product->sku}}">
                </div>
                <div class="form-group">
                    <label for="quantityInput">Quantity</label>
                    <input name="quantity" type="text" class="form-control" id="quantityInput"
                        aria-describedby="quantityHelp" placeholder="Enter Quantity" value="{{$product->quantity}}">
                </div>



                <button type="submit" class="btn btn-light text-dark">Update</button>
            </form>
         


        </div>
        <div class="col-4"></div>

    </div>
</div>

@include('includes.footer')
