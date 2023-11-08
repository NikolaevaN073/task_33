<?php

namespace App\Core;

class View
{
	function generate($content_view, $template_view, $data = null, $title = '')
	{
		include VIEWS .'/'. $template_view;		
	}
}
