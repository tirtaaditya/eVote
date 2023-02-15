<!DOCTYPE html>
<?php
$user = session('user');
?>
<html lang="en">
	<head>
		<title><?= getenv('applicationName')." - ".$title ?></title>
		<link rel="shortcut icon" href="<?=base_url()?>/assets/media/logos/logo.png" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="<?=base_url()?>/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		
		
		<script src="<?=base_url()?>/assets/plugins/global/Chart.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" />
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<style>
			.screen {
				position: fixed;
				transition: all .5s;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: 10;
				background-color: rgba(16, 16, 16, 0.5);
			}

			.loader {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				display: flex;
				align-items: center;
				border-radius:20px;
			}
			
			.autocompletenik {
				position: relative;
			}
			
			.autocompletenik-items div {
				padding: 10px;
				cursor: pointer;
			}

		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="screen">
			<div class="box">
				<div class="loader">
					<div class="spinner-grow text-danger"></div>&nbsp;&nbsp;
					<div class="spinner-grow text-muted"></div>&nbsp;&nbsp;
					<div class="spinner-grow text-primary"></div>&nbsp;&nbsp;
					<div class="spinner-grow text-success"></div>&nbsp;&nbsp;
				</div>
			</div>
		</div>
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<!--begin::Logo-->
						<a href="#">
							<b><span class="menu-section text-muted text-uppercase fs-12 ls-1"><?=getenv('applicationName')?></span></b>
						</a>
						<!--end::Logo-->
						<!--begin::Aside toggler-->
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Aside toggler-->
					</div>
					<!--end::Brand-->
					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
								<?php if($user['role'] == 'Voters') { ?>
								<div class="menu-item">
									<div class="menu-content pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
									</div>
								</div>
								<div class="menu-item">
									<?php
										$urlBeranda = "";
										if($user['role'] !== 'Voters')
										{
											$urlBeranda = base_url();
										}
										else
										{
											$urlBeranda = base_url()."/vote/".base64_encode($user['nik']);
										}
										
									?>
									<a class="menu-link <?php echo ($title == "Beranda") ? "active" : ""; ?>" href="<?=$urlBeranda?>">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Beranda</span>
									</a>
								</div>
								<?php } ?>
 								<div class="menu-item">
									<div class="menu-content pt-8 pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Manajemen</span>
									</div>
								</div>
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo ($title == "Hasil Pemilihan" || $title == "Daftar Peserta") ? "here show" : ""; ?>">
									<span class="menu-link">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="black" />
													<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Pemilihan</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">
										<div class="menu-item">
											<a class="menu-link <?php echo ($title == "Hasil Pemilihan") ? "active" : ""; ?>" href="<?=base_url();?>/pemilihan/hasil">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Hasil</span>
											</a>
										</div>
										<?php if($user['role'] !== 'Voters') { ?>
										<div class="menu-item">
											<a class="menu-link <?php echo ($title == "Daftar Peserta") ? "active" : ""; ?>" href="<?=base_url();?>/pemilihan/peserta">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Daftar Peserta</span>
											</a>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php if($user['role'] !== 'Voters') { ?>
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo ($title == "Daftar Paslon" || $title == "Waktu Voting") ? "here show" : ""; ?>">
									<span class="menu-link">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="black" />
													<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Master Data</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">
										<div class="menu-item">
											<a class="menu-link <?php echo ($title == "Daftar Paslon") ? "active" : ""; ?>" href="<?=base_url();?>/master/paslon">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Daftar Paslon</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php echo ($title == "Waktu Voting") ? "active" : ""; ?>" href="<?=base_url();?>/master/waktu">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Waktu Voting</span>
											</a>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->
					<!--begin::Footer-->
					<div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
						<a href="#" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="Aplikasi eVote">
							<span class="btn-label">eVote V.1.0</span>
							<!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
							<span class="svg-icon btn-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z" fill="black" />
									<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</a>
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" style="" class="header align-items-stretch">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Aside mobile toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
							<!--end::Aside mobile toggle-->
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								<!--begin::Navbar-->
								<div class="d-flex align-items-stretch" id="kt_header_nav">
										<!--begin::Menu-->
											<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><?=$title?>
									<!--end::Menu wrapper-->
								</div>
								<!--end::Navbar-->
								<!--begin::Topbar-->
								<div class="d-flex align-items-stretch flex-shrink-0">
									<!--begin::Toolbar wrapper-->
									<div class="d-flex align-items-stretch flex-shrink-0">
										<?php if($user['role'] !== 'Voters') { ?>
										<!--begin::Notifications-->
										<div class="d-flex align-items-center ms-1 ms-lg-3">
											<!--begin::Menu- wrapper-->
											<div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
												<!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
												<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black" />
														<path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black" />
														<path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black" />
														<path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
											</div>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
												<!--begin::Heading-->
												<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?=base_url()?>/assets/media/misc/pattern-1.jpg')" id="field_header_notification_center">
													<!--begin::Title-->
													<h3 class="text-white fw-bold px-9 mt-10 mb-6">Log Activity
													</h3>
													<!--end::Title-->
													<!--begin::Tabs-->
													<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
														<li class="nav-item">
															<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_3">Logs</a>
														</li>
													</ul>
													<!--end::Tabs-->
												</div>
												<!--end::Heading-->												
											</div>
											<!--end::Menu-->
											<!--end::Menu wrapper-->
										</div>
										<!--end::Notifications-->
										<?php } ?>
										<!--begin::User-->
										<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
											<!--begin::Menu wrapper-->
											<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
												<img src="<?=base_url()?>/assets/media/avatars/blank.png" alt="user" />
											</div>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<div class="menu-content d-flex align-items-center px-3">
														<!--begin::Avatar-->
														<div class="symbol symbol-50px me-5">
															<img alt="Logo" src="<?=base_url()?>/assets/media/avatars/blank.png" />
														</div>
														<!--end::Avatar-->
														<!--begin::Username-->
														<div class="d-flex flex-column">
															<div class="fw-bolder d-flex align-items-center fs-5"><?=$user['name'];?>
															<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Online</span></div>
															<a href="#" class="fw-bold text-muted text-hover-primary fs-7"></a>
														</div>
														<!--end::Username-->
													</div>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu separator-->
												<div class="separator my-2"></div>
												<!--end::Menu separator-->
												<!--begin::Menu item-->
												<div class="menu-item px-5">
													<a href="<?=base_url();?>/main/logout" class="menu-link px-5">Keluar</a>
												</div>
												<!--end::Menu item-->
											</div>
											<!--end::Menu-->
											<!--end::Menu wrapper-->
										</div>
										<!--end::User -->
									</div>
									<!--end::Toolbar wrapper-->
								</div>
								<!--end::Topbar-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-xxl">
							<?=$content;?>
						</div>
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">©2023</span>
								<a href="#" class="text-gray-800 text-hover-primary">InTS</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Menu-->
							<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
								<li class="menu-item">
									<a href="#" class="menu-link px-2">Kopegtel Mediatron</a>
								</li>
							</ul>
							<!--end::Menu-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->		

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--end::Main-->
		<script>var hostUrl = "<?=base_url()?>/assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?=base_url()?>/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?=base_url()?>/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="<?=base_url()?>/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?=base_url()?>/assets/js/custom/widgets.js"></script>
		<script src="<?=base_url()?>/assets/js/custom/apps/chat/chat.js"></script>
		<script src="<?=base_url()?>/assets/js/custom/modals/create-app.js"></script>
		<script src="<?=base_url()?>/assets/js/custom/modals/upgrade-plan.js"></script>
		<script>
			var baseURL = "<?= base_url() ?>";
		
			$(document).ready(function () 
			{
				getListActivity();
			});

			function getListActivity()
			{
				$.ajax(
				{
					type: 'POST',
					url: baseURL + '/main/activity',
					dataType: 'json',
					success: function(response) 
					{
						if(response.code == '00')
						{
							var no = 1;
							response.data.forEach(function(item)
							{
								no = no+1;
								if(no < 7)
								{
									var url = "#";

									const d = new Date(item.created_on);

									let dMy = new Date(item.created_on).toLocaleDateString('id-ID', {
										day: '2-digit',
										month: '2-digit',
										year: 'numeric',
									});

									let hour 	= d.getHours();
									let minute 	= d.getMinutes();

									var htmlItem = '<div class="tab-content">' +
														'<div class="tab-pane fade show active" id="kt_topbar_notifications_2" role="tabpanel">' +
															'<div class="scroll-y mh-325px my-5 px-8">' +
																'<div class="d-flex flex-stack py-4">' +
																	'<div class="d-flex align-items-center me-2">' +
																		'<span class="w-70px badge badge-light-success me-4">'+hour + ':' + minute+'</span>' +
																		'<a href="#" class="text-gray-800 text-hover-primary fw-bold">' + item.activity + '</a>' +
																	'</div>' +
																	'<span class="badge badge-light fs-8">'+ dMy +'</span>' +
																'</div>' +
															'</div>' +
														'</div>' +
													'</div>';

									$('#field_header_notification_center').after(htmlItem);
								}
							});
						}
						else
						{
							alert(response.message);
						}
					}
				});
			}
		</script>
		<!--end::Page Custom Javascript-->
		<script>
			$(document).ready(function () 
			{
				$(".screen").hide();
				$(document).ajaxStart(function()
				{
					$(".screen").show();
				});

				$(document).ajaxStop(function()
				{
					$(".screen").hide();
				});
			});
		</script>
		<?php if (!empty(session()->getFlashdata('errorMessage')) ) : ?>
			<script>
				pesan = "<?= session()->getFlashdata('errorMessage'); ?>";
				
				Swal.fire({
					text: pesan,
					icon: "error",
					buttonsStyling: !1,
					confirmButtonText: "Ok",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				})
			</script>
		<?php endif; ?>
		<?php if (!empty(session()->getFlashdata('successMessage')) ) : ?>
			<script>
				pesan = "<?= session()->getFlashdata('successMessage'); ?>";
				
				Swal.fire({
					text: pesan,
					icon: "success",
					buttonsStyling: !1,
					confirmButtonText: "Ok",
					customClass: {
						confirmButton: "btn btn-primary"
					}
				})
			</script>
		<?php endif; ?>				
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>