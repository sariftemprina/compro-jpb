<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required Meta Tags Always Come First -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title -->
	<title>Users | Front - Admin &amp; Dashboard Template</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/themes/v1/'); ?>assets/css/vendor.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/themes/v1/'); ?>assets/css/theme.minc619.css?v=1.0">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/dashboard.css">

	<link rel="preload" href="<?php echo base_url('assets/themes/v1/'); ?>assets/css/theme.min.css" data-hs-appearance="default" as="style">
	<link rel="preload" href="<?php echo base_url('assets/themes/v1/'); ?>assets/css/theme-dark.min.css" data-hs-appearance="dark" as="style">

	<script src="<?php echo base_url('assets/themes/v1/'); ?>assets/js/vendor.min.js"></script>
	<script src="<?php echo base_url('assets/node_modules/'); ?>tinymce/tinymce.min.js"></script>
	<script src="<?php echo base_url('assets/node_modules/'); ?>datatables/media/js/jquery.dataTables.min.js"></script>
	
	<script src="<?php echo base_url('assets/themes/v1/'); ?>assets/js/hs.theme-appearance.js"></script>
	<script src="<?php echo base_url('assets/themes/v1/'); ?>assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/base64.js"></script>

	<script>
		window.hs_config = {
			"themeAppearance": {
				"layoutSkin": "default",
				"sidebarSkin": "default",
				"styles": {
					"colors": {
						"primary": "#377dff",
						"transparent": "transparent",
						"white": "#fff",
						"dark": "132144",
						"gray": {
							"100": "#f9fafc",
							"900": "#1e2022"
						}
					},
					"font": "Inter"
				}
			}
		}


	</script>

	<script>
		$(document).ready(function(){
			var cmodeIcon	= window.localStorage.getItem('hs_theme_icon') ?? 'bi-moon-stars';
			$("#color-mode > button.btn-icon > i").attr('class', cmodeIcon);
            new HSTogglePassword('.js-toggle-password');
		});

		$(document).on('click', '#color-mode  a.dropdown-item', function(){
			let cmodeIcon = $(this).data('icon');
			let cmodeValue = $(this).data('value');
			$("#color-mode > button.btn-icon > i").attr('class', cmodeIcon);
			window.localStorage.setItem('hs_theme', cmodeValue)
			window.localStorage.setItem('hs_theme_icon', cmodeIcon)
		});
	</script>
</head>

<body class="d-flex align-items-center min-h-100">

  <div class="position-fixed w-100" style="z-index:999;top:0px">
		<div id="toast" class="toast-container top-0 end-0 p-3"></div>
	</div>

  <!-- ========== HEADER ========== -->
  <header class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
    <div class="d-flex d-lg-none justify-content-between">
      <a href="./index.html">
        <img class="w-100" src="<?php echo base_url('themes/v1'); ?>/assets/svg/logos/logo.svg" alt="Image Description" data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
        <img class="w-100" src="<?php echo base_url('themes/v1'); ?>/assets/svg/logos-light/logo.svg" alt="Image Description" data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">
      </a>
    </div>
  </header>
  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main pt-0">
    <!-- Content -->
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-light px-0">

          <div style="max-width: 23rem;">
            <div class="mb-5">
              <h2 class="display-5 mb-3">Sign In to Panel | <?php echo $site['title']; ?></h2>
                <p class="text-center text-xs text-muted"><?php echo $profile['company']; ?></p>
                <!-- End List Checked -->
            </div>
            <!-- End Row -->
          </div>
        </div>
        <!-- End Col -->

        <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
          <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <!-- Form -->
            <img class="w-100" src="<?php echo base_url('files/upload/logo-utama.png'); ?>" alt="Logo">
            <form class="js-validate needs-validation" id="login" method="post">

              <!-- Form -->
              <div class="mb-4 mt-5 pt-5">
                <label class="form-label" for="signinSrEmail">Username</label>
                <input type="text" class="form-control form-control-lg" name="username" id="signinSrEmail" tabindex="1" placeholder="Username" required>
                <span class="invalid-feedback">Please enter a valid email address.</span>
              </div>
              <!-- End Form -->

              <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="signinSrEmail">Password</label>

                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                  <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8" data-hs-toggle-password-options='{
                           "target": "#changePassTarget",
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": "#changePassIcon"
                         }'>
                  <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                    <i id="changePassIcon" class="bi-eye"></i>
                  </a>
                </div>

                <span class="invalid-feedback">Please enter a valid password.</span>
              </div>
              <!-- End Form -->

              <!-- Form Check -->
              <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" value="" id="termsCheckbox">
                <label class="form-check-label" for="termsCheckbox">
                  Remember me
                </label>
              </div>
              <!-- End Form Check -->

              <div class="d-grid">
                <button type="button" class="btn btn-primary btn-lg btn-submit">Sign in</button>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Content -->
  </main>

	<!-- JS Implementing Plugins -->
	<script src="<?php echo base_url('assets/themes/v1/'); ?>assets/js/demo.js"></script>
	<script src="<?php echo base_url('assets/themes/v1/'); ?>assets/js/theme.min.js"></script>

	<script>
		function msg(text,type){
			$("#toast").html(`<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
				<div class="toast-header text-white bg-${type}">
					<strong class="me-auto">Notification</strong>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body">
					${text}
				</div>
			</div>`);

			$(".toast").addClass('show');
		}

        param   = {}
        
        $(document).ready(function(){


        });
        $(document).on('click', 'form#login .btn-submit', function(){
            param.username    = $("[name=username]").val();
            param.password    = $("[name=password]").val();
            $.post('?do=login', param, function(result){
                var x = JSON.parse(result);

                if(x.status == true){
                    window.location='<?php echo base_url('administrator'); ?>'
                }else{
                  msg(x.msg,(x.status == false ? 'danger' : 'primary'));
                }

            });
        });

	</script>
</body>

</html>