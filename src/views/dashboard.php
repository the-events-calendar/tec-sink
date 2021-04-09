<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-gray-800 font-sans leading-normal tracking-normal' ); ?>>
<?php wp_body_open(); ?>
<div class="flex flex-col md:flex-row">
	<div class="bg-gray-800 shadow-xl h-16 fixed bottom-0 md:relative md:h-auto z-10 w-full md:w-48">
		Sidebar lkasjdlfjaslkdjfas alsdjf aldkjf asldjf
	</div>
	<div class="flex-1 bg-gray-100 bottom-0">
		<iframe src="<?php echo esc_url( add_query_arg( [ 'suppress-topbar' => 1 ], home_url() ) ); ?>" onload="javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));" style="border:none;overflow:hidden;width:100%"></iframe>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
