<?php

foreach(glob(__DIR__ . '/actions/*.php') as $action) {
	if(is_file($action)) {
		require_once $action;
	}
}