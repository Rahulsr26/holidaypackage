<? include_once("classes/config.php");

$ref = trim($_REQUEST['ref']);

if ($_REQUEST['action']=="login") {  
  $error=0;
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  if ($username=="") $error=1;
  if ($password=="") $error=1;
  if ($error==1) {
      die("error_validation");
  }else {
    $chkrsq = mysqli_query($con, "select * from users where username='".mysqli_real_escape_string($con,$username)."' and password='".mysqli_real_escape_string($con,md5($password))."'");
    if (mysqli_num_rows($chkrsq)>0) {       
      $chkrs = mysqli_fetch_assoc($chkrsq);
      $_SESSION['TRANSFER_TYPE'] = "ADMIN";
      $_SESSION['TRANSFER_NAME'] = $chkrs['displayname'];
      $_SESSION['TRANSFER_UERNAME'] = $chkrs['username'];
      $_SESSION['TRANSFER_SESSIONSTART'] = gmdate("Y-m-d H:i:s");
      die("success");
    }else {
     die("failed");     
   }

  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Login - <?=PROJECT_TITLE?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
       
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                  
                                        <span><img src="assets/images/logo-dark.png" alt="" height="32"></span>
                                    
                                    <p class="text-muted mb-4 mt-3">Enter your login credentials.</p>
                                </div>

                                <div id="message"></div>

                                <form class="validate-form" action="<?=$_SERVER['PHP_SELF']?>?action=login" method="post" id="mform">
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" placeholder="Enter your username" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password" required>
                                    </div>
                                 

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit" id="save"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                       
                    </div> <!-- end col -->
                </div>
            </div>
        </div>

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <script>
        $("#message").hide();
        $("#mform").validate({
            rules: {
                field: {
                    required: true
                }
            },
            submitHandler: function(form) {
                // submit form
                $("#save").attr("disabled", true);
                var formData = $("#mform").serializeArray();
                var URL = $("#mform").attr("action");
                $.post(URL,
                    formData,
                    function(data, textStatus, jqXHR) {
                        if ($.trim(data)=="success") {
                            <? if ($ref!="") { ?>
                                location.href = "<?=$ref?>";
                            <? } else { ?> 
                                location.href = "add-package";
                            <? } ?>
                            $("#mform").trigger("reset");
                        }
                        if ($.trim(data) == 'failed') {
                            $("#message").html(
                                '<div class="alert alert-danger">Sorry, you have entered wrong login credentials!</div>'
                            );
                            $("#message").show();
                        }
                        if ($.trim(data)=="error_validation") {
                            $("#message").html(
                                '<div class="alert alert-danger">Sorry, form validation failed.</div>'
                            );
                            $("#message").show();
                        }
                        $("#save").attr("disabled", false);

                    }).fail(function(jqXHR, textStatus, errorThrown) {

                    $("#message").html(
                        '<div class="alert alert-danger">Sorry, There was a temporary error.</div>'
                    );
                    $("#message").show();
                });
                return false;
                // end submit
            }
        });
        </script>
        
    </body>
</html>