<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BijBest
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'before' ); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bb' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
		<?php // Substitute the class "container-fluid" below if you want a wider content area. ?>
			<div class="container">
				<div class="row">
					<div class="site-header-inner col-sm-12">

						<?php
						$header_image = get_header_image();
						if ( ! empty( $header_image ) ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php esc_attr( header_image() ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
							</a>
						<?php
						} // end if
						?>


						<div class="site-branding">
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<p class="site-description lead"><?php bloginfo( 'description' ); ?></p>
						</div>

					</div>
				</div>
			</div><!-- .container -->

			<nav id="site-navigation" class="site-navigation" role="navigation">
				<?php // Substitute the class "container-fluid" below if you want a wider content area. ?>
				<div class="container">
					<div class="row">
						<div class="site-navigation-inner col-sm-12">

							<div class="navbar navbar-default">
								<div class="navbar-header">
									<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
										<span class="sr-only"><?php esc_html_e( 'Toggle navigation','bb' ) ?> </span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>

									<!-- Your site title as branding in the menu -->
									<?php // bb_get_header_logo();. ?>
									<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</div>

								<div id="navbar-collapse" class="collapse navbar-collapse">
									<!-- The WordPress Menu goes here -->
									<?php wp_nav_menu(
										array(
											'menu'              => 'primary',
											'menu_id'			=> 'main-menu',
											'theme_location' 	=> 'primary',
											'depth'             => 3,
											'container'         => 'div',
											'container_id'      => '',
											'container_class'   => '',
											'menu_class' 		=> 'nav navbar-nav',
											'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
											'walker' 			=> new wp_bootstrap_navwalker(),
										)
									); ?>

									<ul class="nav navbar-nav navbar-right" aria-expanded="false">
										<li class="menu-item menu-item-has-children dropdown">
											<a title="<?php echo esc_attr__( 'Search', 'bb' ); ?>" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"><span class="visible-xs-inline">Search </span><i class="fa fa-search"></i></a>
											<ul role="menu" class="dropdown-menu">
												<li class="menu-item">
													<form class="form" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
														<div class="input-group">
															<input type="text" class="form-control" placeholder="<?php echo esc_attr__( 'Search', 'bb' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s">
															<div class="input-group-btn">
																<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
															</div>
														</div>
													</form>
												</li>
											</ul>

										</li>
									</ul>

								</div><!-- .navbar-collapse -->

							</div><!-- .navbar -->

						</div><!-- .site-navigation-inner -->
					</div><!-- .row -->
				</div><!-- .container -->
			</nav><!-- #site-navigation -->

		</header><!-- #masthead -->
		
		<div id="content" class="main-container">
			<?php ( is_page_template( 'template-home.php' ) ) ? '' : bb_top_callout(); ?>
			<section class="content-area <?php echo ( get_theme_mod( 'top_callout', true ) ) ? '' : ' pt0 ' ?>">
				<div id="main" class="<?php echo ( ! is_page_template( 'template-home.php' )) ? 'container': 'container-fluid'; ?>" role="main">
						<div class="row">
