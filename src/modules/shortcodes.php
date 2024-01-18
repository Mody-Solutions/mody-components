<?php

namespace mody\shortcodes;

add_shortcode('mody-term-id', function() {
	if(!is_archive()){ return false; }
	$term_id = get_queried_object_id();
	$related = get_field('related', "term_{$term_id}");
	echo \mody\load_template('frontend/invisible-term-id', ['term_id' => $term_id, 'related' => $related]);
});