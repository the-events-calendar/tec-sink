<?php
$sink = new TEC\Sink\Views\Sink;

$selected_theme = $sink->get_selected_theme();
$themes         = $sink->get_themes();
$sections       = $sink->get_sections();
$dashboard      = $sink->is_dashboard_request();
$url            = $dashboard ? admin_url() : home_url();
$topic          = ! empty( $_GET['topic'] ) ? $_GET['topic'] : '';

$url = add_query_arg(
	[
		'tec_sink_topic' => $topic,
	],
	$url
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	<script>
		// Break out of an iframe.
		(function(window) {
			if (window.location !== window.top.location) {
				window.top.location = window.location;
			}
		})(this);
	</script>
</head>

<body <?php body_class( 'bg-gray-800 font-sans leading-normal tracking-normal' ); ?>>
<?php wp_body_open(); ?>
<div class="flex flex-col md:flex-row">
	<nav class="bg-gray-800 shadow-xl h-16 fixed bottom-0 md:relative md:h-auto z-10 w-full md:w-48 p-2 text-base">
		<header class="text-lg text-gray-100 mb-4">TEC Kitchen Sink</header>
		<section class="mb-4">
			<header class="uppercase font-bold text-xs text-gray-500">Theme</header>
			<select
				class="tribe-dropdown"
				id="tec-sink-theme"
				name="tec_sink_theme"
				class=""
			>
				<?php foreach ( $themes as $key => $theme ) : ?>
					<option
						value="<?php echo esc_attr( $key ); ?>"
						<?php selected( $selected_theme, $key ); ?>
					>
						<?php echo esc_html( $theme ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</section>
		<?php foreach ( $sections as $section_slug => $section ) : ?>
			<section class="mb-4">
				<header class="uppercase font-bold text-xs text-gray-500"><?php echo esc_html( $section['name'] ); ?></header>
				<ul class="list-none p-0 text-sm">
					<?php foreach ( $section['topics'] as $topic ) : ?>
						<?php
						$location_url = home_url( tribe( \TEC\Sink\Rewrite\Rewrite_Provider::class )->endpoint );
						$location_url = add_query_arg( $topic->get_url_args(), $location_url );
						?>
						<li class="p-0"><a href="<?php echo esc_url( $location_url ); ?>" class="text-gray-50 hover:underline"><?php echo esc_html( $topic->get_name() ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endforeach; ?>
	</nav>
	<div class="flex-1 bg-gray-100 bottom-0">
		<iframe id="tec-sink-iframe" src="<?php echo esc_url( $url ); ?>" onload="javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));" style="border:none;overflow:hidden;width:100%"></iframe>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
