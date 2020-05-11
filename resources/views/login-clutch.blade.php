<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>Login</title>
</head>
<body>
    <div class="login_wrapper">
        <div class="login_container">
            <div class="logo">
                <img src="/img/clutch_logo.svg" />
            </div>
            <div class="form_wrap">
                <div class="login_content">
                    <div class="header">
                        <div class="header_info">
                            <div class="title">Sign in with LinkedIn</div>
                            <div class="description">to continue to Clutch</div>
                        </div>
                        <img src="/img/clutch_fav.svg" class='header_icon' />
                    </div>
                    <div class="linkedin">
                        <div class="linkedin_title">Why we require LinkedIn profile
                            <div class="linkedin_title_icon">
                                <button class="linkedin_title_button">
                                    <img src="/img/linkedin_title_icon.svg" />
                                </button>
                            </div>
                        </div>
                        <a class="linkedin_button" href={{ URL::to('auth/linkedin') }}>
                            <img src="/img/linkedin_icon.svg" />
                           LinkedIn
                        </a>
                    </div>
                    <div class="content">
                        <div class="separator" />
                       <div class="content_title">
                           Sign in with your Clutch account
                       </div>
                       <form action="#" method="POST">
                            <div class="input_wrap">
                                <div class="input_title">Email</div>
                                <input required="required" type="text" name="email" placeholder="Email" maxlength="256" />
                            </div>
                            <div class="form_button">
                                <button type="submit" class="next"><span>Next</span></button>
                            </div>
                       </form>
                     </div>
                     <div class="info-text">
                         By signing in you agree to our <a href='https://clutch.co/terms'>user agreement</a> and <a href='https://clutch.co/privacy'>privacy policy</a>
                     </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
