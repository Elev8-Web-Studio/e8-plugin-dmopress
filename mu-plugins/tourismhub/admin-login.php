<?php 

function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url('http://jasonpomerleau.com/img/assets/logo.png');
            width: 320px;
            background-position: center center;
            background-size: 300px;
            margin: 0px;
        }

        body.login {
        	background-color: #ffffff;
        }

        #loginform {
        	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
        }

        #wp-submit {
        	background-color: #ff3b30;
        	border-radius: 0px;
        	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
        }

        .wp-core-ui .button-primary {
        	--webkit-box-shadow: none;
        	text-shadow: none;
        	border-color: #ff3b30;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );