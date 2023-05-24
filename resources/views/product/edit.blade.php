<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Product crud</title>
  </head>
  <body>
    <div class="container">
        <div class="row" style="margin-top:50px;">

            <div class="col-md-8 offset-md-2">
                <h2>Update Pruduct Form</h2>

               <div class="card">
                  <div class="card-body">
                    <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Name</label>
                          <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control">
                          <input type="hidden" name="id" value="{{ $product->id }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="product_description" class="form-control" rows="5"> {{ $product->product_description }} </textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Images</label>
                            <input type="file" name="photos[]" multiple class="form-control">
                        </div>

                        <div class="form-group">
                            @foreach ($product->productImages as $image)
                            <img src="{{ asset($image->image) }}" alt="" width="80" height="80" style="border:2px solid red;">
                            <a href="{{ route('image.delete',$image->id) }}" class="btn text-danger" title="remove this image" style="padding:0">X</a>
                        @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                      </form>
                  </div>
               </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
