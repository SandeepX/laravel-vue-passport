<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Ajax Validation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>

<div class="container">
    <h3 style="text-align: center;">Laravel 9 Ajax Validation </h3>

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <div class="col-md-12">
        <div class="row">
            <form method="post" action="javascript:void(0);">
                @csrf
                <div class="form-group col-md-6">
                    <label>First Name:</label>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name">
                </div>

                <div class="form-group col-md-6">
                    <label>Last Name:</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                </div>

                <div class="form-group col-md-6">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
            </form>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </div>


</div>

<script type="text/javascript">

    $(document).ready(function() {

        $(".btn-submit").click(function(e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            $.ajax({
                url: "{{ route('add.form') }}",
                type:'POST',
                data: {
                    _token:_token,
                    first_name:first_name,
                    last_name:last_name,
                    email:email
                },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                        $(".print-error-msg").css({
                            display:"none"
                        });
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });

        });

        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });


</script>


</body>
</html>
