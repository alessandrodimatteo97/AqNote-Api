<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

  <form action="/davide/3/" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
        <input type="text" name="title" class="form-control">
      </div>
      <div class="col-md-6">
        <input type="text" name="description" class="form-control">
      </div>
      <div class="col-md-6">
        <input type="file" name="image0" class="form-control">
      </div>
      <div class="col-md-6">
        <input type="file" name="image1" class="form-control">
      </div><div class="col-md-6">
        <input type="file" name="image2" class="form-control">
      </div><div class="col-md-6">
        <input type="file" name="image3" class="form-control">
      </div>
      <a href="#" class="add-one">Aggiungi sfoglia</a>
      <div class="col-md-6">
        <button type="submit" class="btn btn-success">Upload</button>

          </div>
        </div>

  </form>
</body>
</html>

<script>
  $(document).ready(function(){
    var i = 1;
  $('.add-one').click(function(){
    i=i+1;
    $('.add-one').before("<div >"+
          "<input type="+"file"+" name="+"image"+i+" class="+"form-control"+">"+
    "</div>"
  );
  });
  });
</script>
