<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
						<a href="./forgot" class="forgot-password">Forgot password?</a>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
					<div class="text-center p-t-20">
                    <span class="txt1">
                        Or login with
                    </span>
                </div>

                <div class="text-center p-t-20 d-flex">
                    <button class="login100-form-btn google-btn" onclick="loginWithGoogle()">
                        <i class="zmdi zmdi-google"></i> &nbsp Google
                    </button>
                    <button class="login100-form-btn github-btn" onclick="loginWithGitHub()">
                        <i class="zmdi zmdi-github"></i> &nbsp  GitHub
                    </button>
                </div>
					<div class="text-center p-t-20">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="./signup">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>