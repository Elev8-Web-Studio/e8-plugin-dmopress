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

        #loginform .input {
        	border-top: 0px;
        	border-right: 0px;
        	border-left: 0px;
        	border-bottom: 1px solid #cccccc;
        	background-color: White;
        	box-shadow: none;
        	padding: 6px 0px 12px 0px;
        	transition: border-color .3s;
        	margin-bottom: 20px;
        	
        }

        #loginform .input:focus {
			border-bottom: 2px solid #ff3b30;
        }

        .login #login_error, .login .message {
        	background-color: #ff3b30;
        	box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
        	color: White;
        	border-left: 0px;
        }

        #login_error a {
        	color: White;
        	text-shadow: none;
        }

        #wp-submit {
        	background-color: #ff3b30;
        	border-radius: 0px;
        	box-shadow: none;
        }

        .wp-core-ui .button-primary {
        	--webkit-box-shadow: none;
        	text-shadow: none;
        	border-color: #ff3b30;
        }
        .wp-core-ui .button-primary:hover {
        	--webkit-box-shadow: none;
        	text-shadow: none;
        	border-color: #ff3b30;
        }

        .wp-core-ui .button-primary.active, .wp-core-ui .button-primary.active:focus, .wp-core-ui .button-primary.active:hover, .wp-core-ui .button-primary:active, .wp-core-ui .button-primary:focus {
        	border-color: #ff3b30;
        }

        #backtoblog {
        	display: none; 
        }

        #rememberme {
        	border: 2px solid #cccccc;
        	box-shadow: none;
        	background-color: White;
        }

        input[type=checkbox]:checked:before {
    		content: "\f147";
    		margin: -4px 0 0 -6px;
    		color: #ff3b30;
    		padding: 0px;
		}

        .login #nav {
        	float: right;
        	padding: 10px 5px 0px 0px;
        }

        .login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover {
        	color: #ff3b30;
        }



    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
