<?php
include_once 'geshi.php';
include_once "outmode.inc";

$linelen = 80;
if (!isset($outmode)) {
	$outmode = OutMode::Html;
}
$tpl->define(
	array(
		"any"		=>	"anytext.tpl"
	)
);

function anchor($text, $out = false) {
	global $outmode;
	if ($outmode == OutMode::Html) {
		$anchor = make_anchor("", $text);
		if ($out) {
			out($anchor);
		} else {
			return $anchor;
		}
	}
}

function add_link($text, $url) {
	global $outmode;
	return match ($outmode) {
		OutMode::Html => local_link($text, $url),
		OutMode::NaturalDocs => "<$text>",
		OutMode::PlainText => $text
	};
}

function add_tip($text, $tip) {
	global $outmode;
	return match ($outmode) {
		OutMode::Html => quick_tip($text, $tip),
		OutMode::NaturalDocs => $text,
		OutMode::PlainText => $text
	};
}

function parse_code($source, $lines = false) {
	$geshi = new GeSHi($source, 'ucc');
	$geshi->enable_classes(true);
	if ($lines) {
		$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
		// Blargh... needed for XHTML compliance, though:
		$geshi->set_header_type(GESHI_HEADER_DIV);
	}
	return $geshi->parse_code();
}

function code_block_html($source, $block = true, $lines = false, $offset = 0) {
	$left = $offset / 2 . "em";
	$code = parse_code($source, $lines);
	if ($block) {
		return "<div class=\"codeblock\" style=\"margin-left: $left\">$code</div>";
	} else {
		return "<div class=\"bigcodeblock\" style=\"margin-left: $left\">$code</div>";
	}
}

function code_block_nd($source, $offset = 0) {
	$txt = explode("\n", $source);
	$pad = "// > " . str_pad("", $offset);
	if (is_array($txt)) {
		foreach ($txt as $i => $line) {
			$txt[$i] = $pad . $line;
		}
		$txt = implode("\n", $txt);
	} else {
		$txt = $pad . $txt;
	}
	return "// Definitions:\n$txt\n//\n";
}

function code_block_plaintext($source, $offset = 0, $out = true) {
	if (!$out) {
		return $source;
	}
	global $linelen;
	$len = $linelen - $offset;
	$txt = explode("\n", $source);
	$pad = str_pad("", $offset);
	if (is_array($txt)) {
		foreach ($txt as $i => $line) {
			$txt[$i] = wordwrap($line, $len, "\n$pad" . str_pad("", 8));
		}
		$txt = $pad . implode("\n$pad", $txt);
	} else {
		$txt = $pad . wordwrap($txt, $len, "\n$pad" . str_pad("", 8));
	}
	return "$txt\n";
}

function code_block($source, $block = true, $lines = false, $offset = 0, $out = true) {
	global $outmode;
	// Tabs in <pre> tags looks awful, so we convert to spaces.
	$source = str_replace("\t", "    ", $source);
	$code = match ($outmode) {
		OutMode::Html => code_block_html($source, $block, $lines, $offset),
		OutMode::NaturalDocs => code_block_nd($source, $offset),
		OutMode::PlainText => code_block_plaintext($source, $offset, $out)
	};
	if ($out) {
		out($code);
	} else {
		return $code;
	}
}

function inline_code($source) {
	global $outmode;
	if ($outmode == OutMode::Html) {
		ob_start();
		geshi_highlight($source, 'ucc');
		$code = ob_get_contents();
		ob_end_clean();
		return '<span class="ucc">' . $code . '</span>';
	} elseif ($outmode == OutMode::NaturalDocs) {
		$file1 = "usecode/intrinsics/$source.dat";
		$file2 = str_replace("UI_", "", $file1);
		if (file_exists($file1)) {
			$code = "<UI_$source>";
		} elseif (file_exists($file2)) {
			$code = "<$source>";
		} else {
			$code = $source;
		}
	} elseif ($outmode == OutMode::PlainText) {
		$code = $source;
	}
	return $code;
}

function code_file($file, $block = true, $lines = false, $offset = 0, $out = true) {
	$source = file_get_contents("usecode/$file");
	$code = code_block($source, $block, $lines, $offset, $out);
	if ($out) {
		out($code);
	} else {
		return $code;
	}
}

function join_images($images, $out = true) {
	global $outmode;
	if ($outmode == OutMode::Html) {
		$imgs = implode("", $images);
	} else {
		$imgs = "[" . implode(", ", $images) . "]";
	}
	if ($out) {
		out($imgs);
	} else {
		return $imgs;
	}
}

function make_header_html($text, $level = 2, $anchor = "") {
	if ($level == 2) {
		$tag = "h2";
	} elseif ($level == 1) {
		$tag = "h3";
	} else {
		$tag = "h4";
	}
	return "<$tag>$anchor$text</$tag>";
}

function make_header_nd($text, $level = 2) {
	if ($level == 2) {
		return "// Title: $text\n";
	} elseif ($level == 1) {
		return "\n\n// Function: $text\n";
	} else {
		return "// $text:\n";
	}
}

function make_header_plaintext($text, $level = 2) {
	global $linelen;
	if ($level) {
		if ($level == 2) {
			$head = "=";
		} else {
			$head = "-";
		}
		return str_pad("", $linelen, $head) . "\n$text\n" . str_pad("", $linelen, $head) . "\n";
	} else {
		return "  $text:";
	}
}

function make_header($text, $level = 2, $out = true, $anchor = "") {
	global $outmode;
	if ($outmode != OutMode::NaturalDocs && $level) {
		$text = strtoupper($text);
	}
	$header = match ($outmode) {
		OutMode::Html => make_header_html($text, $level, $anchor),
		OutMode::NaturalDocs => make_header_nd($text, $level),
		OutMode::PlainText => make_header_plaintext($text, $level)
	};
	if ($out) {
		out($header);
	} else {
		return $header;
	}
}

function bold($text) {
	global $outmode;
	return match ($outmode) {
		OutMode::Html => format_text($text, true, false),
		OutMode::NaturalDocs => "*$text*",
		OutMode::PlainText => "*$text*"
	};
}

function italic($text) {
	global $outmode;
	return match ($outmode) {
		OutMode::Html => format_text($text, false, true),
		OutMode::NaturalDocs => "*$text*",
		OutMode::PlainText => "/$text/"
	};
}

function text_html($text, $offset = 4) {
	$left = $offset / 2 . "em";
	if (is_array($text)) {
		$outp = "";
		foreach ($text as $line) {
			$outp .= "<p style=\"margin-left: $left\">$line</p>";
		}
		return $outp;
	} else {
		return "<p style=\"margin-left: $left\">$text</p>";
	}
}

function text_nd($text, $offset = 4) {
	global $linelen;
	if (is_array($text)) {
		$txt = "";
		foreach ($text as $line) {
			$linetxt = wordwrap($line, $linelen - $offset - 3);
			$txt .= "// " . str_pad("", $offset) .
				str_replace("\n", "\n// " . str_pad("", $offset), $linetxt);
			$txt .= "\n//\n";
		}
	} else {
		$txt = wordwrap($text, $linelen - $offset - 3);
		$txt = "// " . str_pad("", $offset) .
			str_replace("\n", "\n// " . str_pad("", $offset), $txt);
		$txt .= "\n//\n";
	}
	return $txt;
}

function text_plaintext($text, $offset = 4) {
	global $linelen;
	if (is_array($text)) {
		$txt = "";
		foreach ($text as $i => $line) {
			$linetxt = wordwrap($line, $linelen - $offset);
			$txt .= str_pad("", $offset) .
				str_replace("\n", "\n" . str_pad("", $offset), $linetxt);
			if ($i === array_key_last($text)) {
				$txt .= "\n";
			} else {
				$txt .= "\n\n";
			}
		}
	} else {
		$txt = wordwrap($text, $linelen - $offset);
		$txt = str_pad("", $offset) .
			str_replace("\n", "\n" . str_pad("", $offset), $txt);
		$txt .= "\n";
	}
	return $txt;
}

function text($text, $offset = 4, $out = true) {
	global $outmode, $linelen;
	$txt = match ($outmode) {
		OutMode::Html => text_html($text, $offset),
		OutMode::NaturalDocs => text_nd($text, $offset),
		OutMode::PlainText => text_plaintext($text, $offset)
	};
	if ($out) {
		out($txt);
	} else {
		return $txt;
	}
}

function add_image($img, $name, $out = true) {
	global $outmode;
	if ($outmode == OutMode::Html) {
		$imgout = image($name, $img);
	} else {
		$imgout = $name;
	}
	if ($out) {
		out($imgout);
	} else {
		return $imgout;
	}
}

function right_align_html($para, $text, $out = true) {
	if ($out) {
		$tag = "p";
	} else {
		$tag = "span";
	}
	return "<$tag class=\"right\">$text</$tag>$para";
}

function right_align_nd($para, $text) {
	global $linelen;
	$namemap = array(
		"[BG]" => "Please note this is a *Black Gate only* intrinsic.",
		"[SI]" => "Please note this is a *Serpent Isle only* intrinsic.",
		"[Exult]" => "Please note this is an *Exult specific* intrinsic.",
		"[Exult: BG]" => "Please note this is a *Black Gate only, Exult specific* intrinsic.",
		"[Exult: SI]" => "Please note this is a *Serpent Isle only, Exult specific* intrinsic.",
		"[BG, Exult]" => "Please note that in the original usecode, this was a *Black Gate only* intrinsic, but Exult has since implemented it in its Serpent Isle support.",
		"[SI, Exult]" => "Please note that in the original usecode, this was a *Serpent Isle only* intrinsic, but Exult has since implemented it in its Black Gate support."
	);
	if (array_key_exists($text, $namemap)) {
		$name = $namemap[$text];
	} else {
		$name = "This is an error; go complain to Marzo about it.";
	}
	return "// " . wordwrap("$name", $linelen - 3, "\n// ") . "\n//\n$para";
}

function right_align_plaintext($para, $text, $out = true) {
	global $linelen;
	$txt = explode("\n", $para);
	$mlen = $linelen - strlen($text) - 8;
	if (is_array($txt)) {
		$fline = $txt[0];
	} else {
		$fline = $txt;
	}
	if (strlen($fline) > $mlen) {
		$lines = wordwrap($fline, $mlen, "\n" . str_pad("", 8));
		$lines = explode("\n", $lines);
		$lines[0] = str_pad($lines[0], $linelen - strlen($text)) . $text;
		$fline = implode("\n", $lines);
	} else {
		$fline = str_pad($fline, $linelen - strlen($text)) . $text;
	}

	if (is_array($txt)) {
		$txt[0] = $fline;
		foreach ($txt as $i => $line) {
			if ($i > 0) {
				$txt[$i] = wordwrap($line, $linelen, "\n" . str_pad("", 8));
			}
		}
		$txt = implode("\n", $txt);
	} else {
		$txt = $fline;
	}
	return $txt . ($out ? "\n" : "");
}

function right_align($para, $text, $out = true) {
	global $outmode, $linelen;
	$txt = match ($outmode) {
		OutMode::Html => right_align_html($para, $text, $out),
		OutMode::NaturalDocs => right_align_nd($para, $text),
		OutMode::PlainText => right_align_plaintext($para, $text, $out)
	};
	if ($out) {
		out($txt);
	} else {
		return $txt;
	}
}

function add_list_html($items, $bullet = false, $offset = 8) {
	$tag = $bullet ? "ul" : "ol";
	$type = ($bullet === -1) ? "; list-style-type: none" : "";
	$left = $offset / 4 . "em";
	$list = "<$tag  style=\"margin-left: $left$type\">";
	foreach ($items as $line) {
		$list .= "<li>$line</li>";
	}
	return $list . "</$tag>";
}

function add_list_nd($items, $bullet = false) {
	$ident = $bullet ? 3 : 7;
	$img = "// * ";
	$list = "";
	foreach ($items as $j => $line) {
		$num = $j + 1;
		$indicator = str_pad($bullet ? $img : "// $num - ", $ident);
		$lineout = "$indicator$line\n";
		$list .= $lineout;
	}
	return $list . "//\n";
}

function add_list_plaintext($items, $bullet = false, $offset = 8) {
	global $linelen;
	if ($bullet === -1) {
		$ident = 0;
	} else {
		$ident = $bullet ? 2 : 6;
	}
	$img = ($bullet === -1) ? "" : "*";
	$list = "";
	foreach ($items as $j => $line) {
		$num = $j + 1;
		$indicator = str_pad($bullet ? $img : "($num)", $ident);
		$lineout = wordwrap($indicator . $line, $linelen - $ident - $offset);
		$list .= str_pad("", $offset) .
			str_replace("\n", "\n" . str_pad("", $offset + $ident), $lineout) . "\n";
	}
	return $list;
}

function add_list($items, $bullet = false, $offset = 8, $out = true) {
	global $outmode;
	$list = match ($outmode) {
		OutMode::Html => add_list_html($items, $bullet, $offset),
		OutMode::NaturalDocs => add_list_nd($items, $bullet),
		OutMode::PlainText => add_list_plaintext($items, $bullet, $offset)
	};
	if ($out) {
		out($list);
	} else {
		return $list;
	}
}

function add_2dlist_html($items, $cols = 4, $group = 2, $offset = 8, $border = 1) {
	// Easy.
	$lastindex = count($items) - 1;
	$lastmember = $group - 1;
	$cols += $group;
	$left = $offset / 2 . "em";
	$list = "<table style=\"margin-left: $left\" border=\"$border\"><tbody><tr>";
	foreach ($items as $j => $item) {
		if ($j > 0 && $j != $lastindex && $j % $cols == 0) {
			$list .= "</tr><tr>";
		}
		if ($j % $group == 0) {
			$list .= "<td>";
		} elseif ($group != 1) {
			$list .= " ";
		}
		$list .= $item;
		if ($j % $group == $lastmember) {
			$list .= "</td>";
		}
	}
	return $list . "</tr></tbody></table>";
}

function add_2dlist_nd($items, $group = 2) {
	// Moderate difficulty.
	$lastcol = $group - 1;
	$list = "";
	foreach ($items as $j => $item) {
		$col = $j % $group;
		if ($col == 0) {
			$list .= "// $item -";
		} else {
			$list .= " $item";	// Needs work.
		}
		if ($col == $lastcol) {
			$list .= "\n";
		}
	}
	return $list . "//\n";
}

function add_2dlist_plaintext($items, $cols = 4, $offset = 8) {
	// Much harder
	// Determine the number of spaces that we'll need to align the table.
	$lastindex = count($items) - 1;
	for ($i = 0; $i < $cols; $i++) {
		$lens[] = 0;
	}
	foreach ($items as $j => $item) {
		$col = $j % $cols;
		if (strlen($item) > $lens[$col]) {
			$lens[$col] = strlen($item);
		}
	}
	$list = str_pad("", $offset);
	$lastcol = $cols - 1;
	foreach ($items as $j => $item) {
		$col = $j % $cols;
		if ($j > 0 && $j != $lastindex && $col == 0) {
			$list .= "\n" . str_pad("", $offset);
		}
		if ($col < $lastcol && $j != $lastindex) {
			$list .= str_pad($item, $lens[$col] + 4);
		} else {
			$list .= $item;
		}
	}
	return $list . "\n";
}

function add_2dlist($items, $cols = 4, $group = 2, $offset = 8, $out = true, $border = 1) {
	global $outmode;
	$list = match ($outmode) {
		OutMode::Html => add_2dlist_html($items, $cols, $group, $offset, $border),
		OutMode::NaturalDocs => add_2dlist_nd($items, $group),
		OutMode::PlainText => add_2dlist_plaintext($items, $cols, $offset)
	};
	if ($out) {
		out($list);
	} else {
		return $list;
	}
}

function table_html($rows, $offset = 8, $border = 1) {
	// Much easier
	$left = $offset / 2 . "em";
	$table = "<table style=\"margin-left: $left\" border=\"$border\"><tbody>";
	foreach ($rows as $row) {
		$table .= "<tr>";
		foreach ($row as $col) {
			$table .= "<td>$col</td>";
		}
		$table .= "</tr>";
	}
	return $table . "</tbody></table>";
}

function table_nd($rows) {
	// Moderate difficulty.
	$table = "";
	foreach ($rows as $i => $row) {
		if ($i != 0) {
			foreach ($row as $item) {
				$coltxt = preg_replace('/\s+=\s+/', ' - ', $item);
				$table .= "// $coltxt\n";
			}
		}
	}
	return $table . "//\n";
}

function table_plaintext($rows, $offset = 8) {
	// Much harder
	global $linelen;
	$table = "";
	$cols = count($rows[0]);
	// Determine the number of spaces that we'll need to align the table.
	for ($i = 0; $i < $cols; $i++) {
		$lens[] = 0;
	}
	$cols -= 1;
	foreach ($rows as $row) {
		foreach ($row as $j => $col) {
			if (strlen($col) > $lens[$j] && $j < $cols) {
				$lens[$j] = strlen($col);
			}
		}
	}
	$lastpos = 0;
	foreach ($lens as $len) {
		$lastpos += $len + 4;
	}
	$lastpos -= $lens[$cols] + 4;
	// Not output the table.
	foreach ($rows as $row) {
		$table .= str_pad("", $offset);
		foreach ($row as $j => $col) {
			if ($j < $cols) {
				$table .= str_pad($col, $lens[$j] + 4);
			} else {
				$lines = wordwrap($col, $linelen - $lastpos - $offset, "\n" . str_pad("", $lastpos + $offset));
				$table .= $lines;
			}
		}
		$table .= "\n";
	}
	return $table;
}

function table($rows, $offset = 8, $border = 1, $out = true) {
	global $outmode, $linelen;
	$table = match ($outmode) {
		OutMode::Html => table_html($rows, $offset, $border),
		OutMode::NaturalDocs => table_nd($rows),
		OutMode::PlainText => table_plaintext($rows, $offset)
	};
	if ($out) {
		out($table);
	} else {
		return $table;
	}
}

function add_keylist_html($items, $offset = 8, $border = 1) {
	// Much easier
	$left = $offset / 2 . "em";
	$list = "<table style=\"margin-left: $left\" border=\"$border\"><tbody>";
	foreach ($items as $i => $col) {
		if ($i % 2 == 0) {
			$list .= "<tr>";
		}
		$list .= "<td>$col</td>";
		if ($i % 2 == 1) {
			$list .= "</tr>";
		}
	}
	return $list . "</tbody></table>";
}

function add_keylist_nd($items, $offset = 8) {
	return add_2dlist($items, 2, 2, $offset, false);
}

function add_keylist_plaintext($items, $offset = 8) {
	// Much harder
	global $linelen;
	// Determine the number of spaces that we'll need to align the table.
	$lastindex = count($items) - 1;
	for ($i = 0; $i < 2; $i++) {
		$lens[] = 0;
	}
	foreach ($items as $j => $item) {
		$col = $j % 2;
		$len = strlen($item);
		$lens[$col] = max($len, $lens[$col]);
	}
	$len0 = $lens[0] + 4;
	$len1 = $offset + $len0;
	$off0 = str_pad("", $offset);
	$off1 = "\n" . str_pad("", $len1);
	$list = "";
	foreach ($items as $j => $item) {
		$col = $j % 2;
		if ($col == 0) {
			if (strlen($item) != 0) {
				$list .= $off0;
			}
			if ($j == $lastindex) {
				$list .= $item;
			} else {
				$list .= str_pad($item, $len0);
			}
		} else {
			$list .= wordwrap($item, $linelen - $len1, $off1) . "\n";
		}
	}
	return $list;
}

function add_keylist($items, $offset = 8, $out = true, $border = 1) {
	global $outmode;
	$list = match ($outmode) {
		OutMode::Html => add_keylist_html($items, $offset, $border),
		OutMode::NaturalDocs => add_keylist_nd($items, $offset),
		OutMode::PlainText => add_keylist_plaintext($items, $offset)
	};
	if ($out) {
		out($list);
	} else {
		return $list;
	}
}

function add_box($rows, $offset = 4, $out = true, $border = 1) {
	global $outmode, $linelen;
	if ($outmode == OutMode::Html) {
		$left = $offset / 2 . "em";
		$box = "<table style=\"margin-left: $left\" border=\"$border\"><tbody>";
		foreach ($rows as $row) {
			$box .= "<tr><td>$row</td></tr>";
		}
		$box .= "</tbody></table>";
	} elseif ($outmode == OutMode::NaturalDocs) {
		$header = "// $rows[0]:\n// ";
		$lines = array_slice($rows, 1);
		$text = implode("\n", $lines);
		$box = str_pad("", $offset) . wordwrap($text, $linelen - $offset - 3);
		$box = $header . str_replace("\n", "\n// " . str_pad("", $offset), $box);
		$box .= "\n//\n";
	} else {
		$length = strlen($rows[0]) + 2;
		$padlen = max(25, $length + 8);
		$header = str_pad($rows[0], $length, " ", STR_PAD_BOTH);
		$header = str_pad($header, $padlen, "*", STR_PAD_BOTH) . "\n";
		$footer = str_pad("END " . $rows[0], $length + 4, " ", STR_PAD_BOTH);
		$footer = str_pad($footer, $padlen, "*", STR_PAD_BOTH);
		$lines = array_slice($rows, 1);
		$text = wordwrap(implode("\n", $lines), $linelen - $offset);
		$lines = explode("\n", $text);
		$off0 = str_pad("", $offset);
		$box = $off0 . $header;
		foreach ($lines as $line) {
			if (strlen($line)) {
				$box = $box . $off0 . $line;
			}
			$box .= "\n";
		}
		$box .= $off0 . $footer . "\n";
	}
	if ($out) {
		out($box);
	} else {
		return $box;
	}
}

function out($text) {
	global $tpl;
	$tpl->assign("TEXT", $text);
	$tpl->parse("CONTENT", ".any");
}
