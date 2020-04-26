<?php
use Phppot\Member;
if (!empty($_POST["signup-btn"])) {
    require_once './Model/Member.php';
    $member = new Member();
    $registrationResponse = $member->registerMember();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Smart Home Register</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form class="login-form text-center" action="" method="POST" onsubmit="signupValidation()">
            <h1 class="mb-5 font-weight-light text-uppercase">Register</h1>
            <?php 
				if(!empty($registrationResponse["status"]))
				{
				?>
                    <?php 
                    if($registrationResponse["status"] == "error")
                    {
                    ?>
				    <div class="server-response error-msg"><?php echo $registrationResponse["message"]; ?></div>
                    <?php 
				    } 
				    else if($registrationResponse["status"] == "success")
				    {
                    ?>
                    <div class="server-response success-msg"><?php echo $registrationResponse["message"]; ?></div>
                    <?php 
				    }
                    ?>
				<?php 
				}
                ?>
            <div class="error-msg" id="error-msg"></div>
            <div class="form-group">
                <div class="form-label">
					Email<span class="required error" id="email-info"></span>
				</div>
                <input type="email" name="email" id="email" class="form-control rounded-pill form-control-lg">
            </div>
            <div class="form-group">
                <div class="form-label">
					Username<span class="required error" id="username-info"></span>
                </div>
                <input type="text" name="username" id="username" class="form-control rounded-pill form-control-lg" >
            </div>
            <div class="form-group">
                <div class="form-label">
					Password<span class="required error" id="signup-password-info"></span>
				</div>
                <input type="password" name="signup-password" id="signup-password" class="form-control rounded-pill form-control-lg">
            </div>
            <div class="form-group">
                <div class="form-label">
					Confirm Password<span class="required error" id="confirm-password-info"></span>
				</div>
                <input type="password" name="confirm-password" id="confirm-password" class="form-control rounded-pill form-control-lg">
            </div>
            <!-- <div class="forgot-link form-group d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember Password</label>
                </div>
                <a href="#">Forgot Password?</a>
            </div> -->
            <!-- <button type="submit" name="signup-btn" class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase">Register</button> -->
            <input class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase" type="submit" name="signup-btn" id="signup-btn" value="Sign up">
            <p class="mt-3 font-weight-normal">Already have an account? <a href="login.php"><strong>Login Now</strong></a></p>
        </form>
    </div>

    <script>
function signupValidation() {
	var valid = true;
	
	$("#username").removeClass("error-field");
	$("#email").removeClass("error-field");
	$("#password").removeClass("error-field");
	$("#confirm-password").removeClass("error-field");
	
	var UserName = $("#username").val();
	var email = $("#email").val();
	var Password = $('#signup-password').val();
    var ConfirmPassword = $('#confirm-password').val();
	var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
		
	$("#username-info").html("").hide();
	$("#email-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html(" required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}
	if (email == "") {
		$("#email-info").html(" required").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (email.trim() == "") {
		$("#email-info").html(" Invalid email address.").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
		valid = false;
	} else if (!emailRegex.test(email)) {
		$("#email-info").html(" Invalid email address.").css("color", "#ee0000")
				.show();
		$("#email").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#signup-password-info").html(" required.").css("color", "#ee0000").show();
		$("#signup-password").addClass("error-field");
		valid = false;
	}
	if (ConfirmPassword.trim() == "") {
		$("#confirm-password-info").html(" required.").css("color", "#ee0000").show();
		$("#confirm-password").addClass("error-field");
		valid = false;
	}
	if(Password != ConfirmPassword){
        $("#error-msg").html(" Both passwords must be same.").show();
        valid=false;
    }
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;	
}
</script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>