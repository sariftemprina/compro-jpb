<!DOCTYPE HTML>
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

<body class="footer-offset">
	<input type="checkbox" class="d-none form-check-input" id="builderFluidSwitch">
	<div class="position-fixed w-100" style="z-index:999;top:0px">
		<div id="toast" class="toast-container top-0 end-0 p-3"></div>
	</div>
	<main id="content" role="main" class="main">

		<!-- Content -->
		<div class="content container-fluid py-2">
			<div class="mb-3 d-flex justify-content-between">
				<p class="fs-3"><?php echo $title; ?></p>
				<ol class="breadcrumb breadcrumb-no-gutter fs-6">
					<?php
						if(isset($breadcrumb)){
							foreach($breadcrumb as $k => $v){
								if($k == count($breadcrumb)-1){
									echo "<li class='breadcrumb-item active' aria-current='".$v['text']."'>".$v['text']."</li>";
								}else{
									echo "<li class='breadcrumb-item'><a class='breadcrumb-link' href='".$v['url']."'>".$v['text']."</a></li>";
								}
							}
						}                            
					?>
				</ol>
			</div>
			<?php $this->load->view($content); ?>
		</div>
		<div class="footer">
			<div class="row justify-content-between align-items-center">
				<div class="col">
					<p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span>
					</p>
				</div>
				<!-- End Col -->

				<div class="col-auto">
					<div class="d-flex justify-content-end">
						<!-- List Separator -->
						<ul class="list-inline list-separator">
							<li class="list-inline-item">
								<a class="list-separator-link" href="#">FAQ</a>
							</li>

							<li class="list-inline-item">
								<a class="list-separator-link" href="#">License</a>
							</li>

							<li class="list-inline-item">
								<!-- Keyboard Shortcuts Toggle -->
								<button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle"
									type="button" data-bs-toggle="offcanvas"
									data-bs-target="#offcanvasKeyboardShortcuts"
									aria-controls="offcanvasKeyboardShortcuts">
									<i class="bi-command"></i>
								</button>
								<!-- End Keyboard Shortcuts Toggle -->
							</li>
						</ul>
						<!-- End List Separator -->
					</div>
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>
	</main>

	<div class="d-none js-build-layouts">
		<div class="js-build-layout-header-double">
			<!-- Double Header -->
			<header id="header" class="navbar navbar-expand-lg navbar-bordered navbar-spacer-y-0 flex-lg-column">
				<div class="navbar-dark w-100 bg-dark py-2">
					<div class="container">
						<div class="navbar-nav-wrap">
							<!-- Logo -->
							<a class="navbar-brand" href="<?php echo base_url('administrator'); ?>" aria-label="Front">
								<img class="navbar-brand-logo" src="<?php echo base_url('files/upload/logo-utama.png'); ?>" alt="Logo">
							</a>
							<!-- End Logo -->

							<!-- Content End -->
							<div class="navbar-nav-wrap-content-end">
								<!-- Navbar -->
								<ul class="navbar-nav">

									<li class="nav-item d-none d-sm-inline-block">
										<!-- Activity -->
										<button class="btn btn-ghost-light btn-icon rounded-circle" type="button"
											data-bs-toggle="offcanvas" data-bs-target="#offcanvasActivityStream"
											aria-controls="offcanvasActivityStream">
											<i class="bi-x-diamond"></i>
										</button>
										<!-- Activity -->
									</li>

									<li class="nav-item">
										<!-- Style Switcher -->
										<div class="dropdown " id="color-mode" >
											<button type="button" class="btn btn-ghost-light btn-icon rounded-circle"
												id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
												data-bs-dropdown-animation>
												<i class="bi-moon"></i>
											</button>

											<div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless"
												aria-labelledby="selectThemeDropdown">
												<a class="dropdown-item" href="#" data-icon="bi-moon-stars"
													data-value="auto">
													<i class="bi-moon-stars me-2"></i>
													<span class="text-truncate" title="Auto (system default)">Auto
														(system default)</span>
												</a>
												<a class="dropdown-item" href="#" data-icon="bi-brightness-high"
													data-value="default">
													<i class="bi-brightness-high me-2"></i>
													<span class="text-truncate" title="Default (light mode)">Default
														(light mode)</span>
												</a>
												<a class="dropdown-item active" href="#" data-icon="bi-moon"
													data-value="dark">
													<i class="bi-moon me-2"></i>
													<span class="text-truncate" title="Dark">Dark</span>
												</a>
											</div>
										</div>

										<!-- End Style Switcher -->
									</li>

									<li class="nav-item">
										<!-- Account -->
										<div class="dropdown">
											<a class="navbar-dropdown-account-wrapper" href="javascript:;"
												id="accountNavbarDropdown" data-bs-toggle="dropdown"
												aria-expanded="false" data-bs-auto-close="outside"
												data-bs-dropdown-animation>
												<div class="avatar avatar-sm avatar-circle">
													<img class="avatar-img" src="<?php echo base_url('assets/themes/v1/'); ?>assets/img/160x160/img6.jpg"
														alt="Image Description">
													<span
														class="avatar-status avatar-sm-status avatar-status-success"></span>
												</div>
											</a>

											<div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
												aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
												<div class="dropdown-item-text">
													<div class="d-flex align-items-center">
														<div class="avatar avatar-sm avatar-circle">
															<img class="avatar-img" src="<?php echo base_url('assets/themes/v1/'); ?>assets/img/160x160/img6.jpg"
																alt="Image Description">
														</div>
														<div class="flex-grow-1 ms-3">
															<h5 class="mb-0">Mark Williams</h5>
															<p class="card-text text-body">mark@site.com</p>
														</div>
													</div>
												</div>

												<div class="dropdown-divider"></div>

												<a class="dropdown-item" href="#">Change Password</a>

												<div class="dropdown-divider"></div>

												<a class="dropdown-item" href="<?php echo base_url('main/login'); ?>">Sign out</a>
											</div>
										</div>
										<!-- End Account -->
									</li>

									<li class="nav-item">
										<!-- Toggler -->
										<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
											data-bs-target="#navbarDoubleLineContainerNavDropdown"
											aria-controls="navbarDoubleLineContainerNavDropdown" aria-expanded="false"
											aria-label="Toggle navigation">
											<span class="navbar-toggler-default">
												<i class="bi-list"></i>
											</span>
											<span class="navbar-toggler-toggled">
												<i class="bi-x"></i>
											</span>
										</button>
										<!-- End Toggler -->
									</li>
								</ul>
								<!-- End Navbar -->
							</div>
							<!-- End Content End -->
						</div>
					</div>
				</div>

				<div class="container">
					<nav class="js-mega-menu d-block w-100">
						<!-- Collapse -->
						<div class="collapse navbar-collapse" id="navbarDoubleLineContainerNavDropdown">
							<ul class="navbar-nav">
								<!-- Dashboards -->
								<li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('administrator'); ?>" data-placement="left">
										<i class="bi-house-door dropdown-item-icon"></i> Dashboard
									</a>
								</li>
								<!-- End Dashboards -->

								<!-- Pages -->
								<li class="hs-has-sub-menu nav-item">
									<a id="pagesMegaMenu" class="hs-mega-menu-invoker nav-link dropdown-toggle" href="#" role="button">
										<i class="bi-files-alt dropdown-item-icon"></i> Content Management
									</a>

									<div class="hs-sub-menu dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="pagesMegaMenu" style="min-width: 14rem;">
										<a class="dropdown-item " href="<?php echo base_url('administrator/profile'); ?>" data-placement="left">
											Profile
										</a>
										<div class="hs-has-sub-menu nav-item">
											<a id="usersMegaMenu" class="hs-mega-menu-invoker dropdown-item dropdown-toggle " href="#" role="button">News and Articles</a>
											<div class="hs-sub-menu dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="usersMegaMenu" style="min-width: 14rem;">
												<a class="dropdown-item " href="<?php echo base_url('administrator/news/form'); ?>">Create New</a>
												<a class="dropdown-item " href="<?php echo base_url('administrator/news/list'); ?>">Browse</a>
											</div>
										</div>
										<!-- <div class="hs-has-sub-menu nav-item">
											<a id="usersMegaMenu" class="hs-mega-menu-invoker dropdown-item dropdown-toggle " href="#" role="button">Gallery and Album</a>
											<div class="hs-sub-menu dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="usersMegaMenu" style="min-width: 14rem;">
												<a class="dropdown-item " href="<?php echo base_url('administrator/gallery/form'); ?>">Create New</a>
												<a class="dropdown-item " href="<?php echo base_url('administrator/gallery/list'); ?>">Browse</a>
											</div>
										</div> -->
										<div class="hs-has-sub-menu nav-item">
											<a id="usersMegaMenu" class="hs-mega-menu-invoker dropdown-item dropdown-toggle " href="#" role="button">Catalogue Product</a>
											<div class="hs-sub-menu dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="usersMegaMenu" style="min-width: 14rem;">
												<a class="dropdown-item " href="<?php echo base_url('administrator/product/form'); ?>">Create New</a>
												<a class="dropdown-item " href="<?php echo base_url('administrator/product/list'); ?>">Browse</a>
											</div>
										</div>
									</div>
								</li>

                                <li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('administrator/images'); ?>" data-placement="left">
										<i class="bi-list dropdown-item-icon"></i> Photos
									</a>
								</li>

                                <li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('administrator/menu'); ?>" data-placement="left">
										<i class="bi-list dropdown-item-icon"></i> Menu Setting
									</a>
								</li>

                                <li class="nav-item">
									<a class="nav-link" href="<?php echo base_url('administrator/user'); ?>" data-placement="left">
										<i class="bi-people dropdown-item-icon"></i> User Setting
									</a>
								</li>

							</ul>
						</div>
						<!-- End Collapse -->
					</nav>
				</div>
			</header>
			<!-- End Double Header -->
		</div>
	</div>

	<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasActivityStream"
		aria-labelledby="offcanvasActivityStreamLabel">
		<div class="offcanvas-header">
			<h4 id="offcanvasActivityStreamLabel" class="mb-0">Activity stream</h4>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">

		</div>
	</div>

	<div class="modal fade" id="appModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header py-3">
					<h3 class="modal-title"></h3>
					<div class="modal-close">
						<button type="button" class="btn btn-ghost-secondary btn-icon btn-sm" data-bs-dismiss="modal" aria-label="Close">
							<i class="bi-x-lg"></i>
						</button>
					</div>
				</div>
				<div class="modal-body">

                </div>
				<div class="modal-footer d-block text-end p-3">

                </div>
			</div>
		</div>
	</div>


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
		

		const image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
			const reader = new FileReader();

			reader.onload = (e) => {
				const formData 	= new FormData();
				const xhr 		= new XMLHttpRequest();

				var base64data	= e.target.result;
				formData.append('img', base64data);

				xhr.withCredentials = false;
				xhr.open('POST', '<?php echo base_url(); ?>administrator/images?do=upload');

				// xhr.upload.onprogress = (e) => {
				// progress(e.loaded / e.total * 100);
				// };

				xhr.onload = () => {
				if (xhr.status === 403) {
					reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
					return;
				}

				if (xhr.status < 200 || xhr.status >= 300) {
					reject('HTTP Error: ' + xhr.status);
					return;
				}

				const json = JSON.parse(xhr.responseText);

				if (!json || typeof json.location != 'string') {
					reject('Invalid JSON: ' + xhr.responseText);
					return;
				}

				resolve('<?php echo base_url(); ?>' + json.location);
				};

				xhr.onerror = () => {
				reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
				};

				xhr.send(formData);
			};

			reader.onerror = () => {
				reject('Error reading file');
			};

			reader.readAsDataURL(blobInfo.blob());
		});

		const tinyoption	= {
			selector: 'textarea.tiny',
			toolbar: 'underline italic bold align | numlist bullist | undo redo | link image media',
			plugins: 'image code lists',
			height: 400,
			image_title: true,
			automatic_uploads: true,
			file_picker_types: 'image',
			images_upload_handler: image_upload_handler,

			file_picker_callback: (cb, value, meta) => {
				const input = document.createElement('input');
				input.setAttribute('type', 'file');
				input.setAttribute('accept', 'image/*');

				input.formEventListener('change', (e) => {
					const file = e.target.files[0];

					const reader = new FileReader();
					reader.formEventListener('load', () => {
						const id = 'blobid' + (new Date()).getTime();
						const blobCache = tinymce.activeEditor.editorUpload.blobCache;
						const base64 = reader.result.split(',')[1];
						const blobInfo = blobCache.create(id, file, base64);
						blobCache.form(blobInfo);

						cb(blobInfo.blobUri(), {
							title: file.name
						});
					});
					reader.readAsDataURL(file);
				});

				input.click();
			},
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
		}

		tinymce.init(tinyoption);


	</script>
</body>

</html>