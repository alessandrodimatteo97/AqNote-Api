<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

<form action="/davide" method="POST" enctype="multipart/form-data">
    <div class="row">
        @foreach($arrayImg as $img)
        <div class="col-md-6">
            <img src="{{url($img)}}" height="130px" width="130px"/>
        </div>
        @endforeach
    </div>

</form>
</body>
</html>


