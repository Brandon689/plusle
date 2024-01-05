<!DOCTYPE html>
<html data-theme="winter" <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

<div id="page" class="bg-base-100 text-base-content">
	<div class="navbar bg-base-200 px-14 py-8 border-b-2 border-neutral-content mb-6">
	  <div class="flex-1">
	    <a class="btn btn-ghost text-xl" href="/"><img class="w-28" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo.jpg"/></a>
		<ul class="menu uppercase menu-horizontal rounded-box text-base font-bold">
			<li><a href="/shop/">New Arrival</a></li>
			<li><a href="/shop/">Series</a></li>
			<li><a href="/shop/">Types</a></li>
		</ul>
	  </div>

	  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
	  <li><button id="themeSwitcher">Toggle Theme</button></li>
    </ul>
  </div>
	  <div class="flex-none">
	    <a href="/cart">
		    <div role="button" class="btn btn-ghost btn-circle">
		        <div class="indicator">
		          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
		        </div>
		   	</div>
	    </a>
	    <div class="dropdown dropdown-end">
	      <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
	        <div class="w-10 rounded-full">
	          <!-- <img alt="Tailwind CSS Navbar component" src="" /> -->
			  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
</svg>


	        </div>
	      </div>
	      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 border-black card card-bordered rounded-box w-28">
	        <li>
	          <a class="justify-between">
	            Profile
	          </a>
	        </li>
	        <li><a>Settings</a></li>
	        <li><a>Logout</a></li>
	      </ul>
	    </div>
	  </div>
	</div>

	<div id="content" class="">
		<main>
