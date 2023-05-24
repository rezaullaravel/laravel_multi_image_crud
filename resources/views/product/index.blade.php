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
            <div class="col-md-7">
               <h2>Product list</h2>
               @if (Session('info'))
               <div class="alert alert-success">
                   {{ Session::get('info') }}
               </div>
               @endif
               <table class="table table-bordered">
                 <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                 </thead>

                 <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>
                            @foreach ($product->productImages as $image)
                                <img src="{{ asset($image->image) }}" alt="" width="40" height="40" style="border:2px solid red; margin:6px 0">
                                <a href="{{ route('image.delete',$image->id) }}" class="btn text-danger" title="remove this image" style="padding:0">X</a>
                            @endforeach
                        </td>

                        <td>
                            <a href="{{ route('product.edit',$product->id) }}" class="btn btn-success btn-sm">Edit</a>
                            <a href="{{ route('product.delete',$product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete???');">Delete</a>
                        </td>
                    </tr>
                    @endforeach

                 </tbody>
               </table>
            </div>
            <div class="col-md-5">
                <h2>Add Pruduct Form</h2>
                    @if (Session('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                    @endif


               <div class="card">
                  <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Name</label>
                          <input type="text" name="product_name" class="form-control"  placeholder="Enter name">

                            @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="product_description" class="form-control"  placeholder="Enter product description" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Images</label>
                            <input type="file" name="photos[]" multiple class="form-control">
                            @error('photos')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
