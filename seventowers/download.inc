<?php
	$tpl->define(
		array(
			"d_link"		=>	"download_link.tpl",
			"doc_link"		=>	"doc_link.tpl",
			"read_link"		=>	"readme_link.tpl",
			"finfo"			=>	"file_info.tpl",
			"icon_link"		=>	"icon_link.tpl"
		)
	);
	
	include("content/$DATAFILE");
	include("content/$SUBMENUFILE");
	
	$tpl->parse("MAIN", "main");
	$tpl->FastPrint();
	exit;
	
	function get_file_info( $extension )
	{
		$ext_nfo = array(
			// File archives
				"zip"	=>	array(	"DIR"		=>	"../snapshots",
									"DIR2"		=>	"files",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"read_link"),
				"tar.gz"=>	array(	"DIR"		=>	"../snapshots",
									"DIR2"		=>	"files",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"read_link"),
				"7z"	=>	array(	"DIR"		=>	"../snapshots",
									"DIR2"		=>	"files",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"read_link"),
				"exe"	=>	array(	"DIR"		=>	"../snapshots",
									"DIR2"		=>	"files",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"read_link"),
			// Documents
				"txt"	=>	array(	"DIR"		=>	"docs",
									"DIR2"		=>	"docs",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"empty_tpl"),
				"php"	=>	array(	"DIR"		=>	"docs",
									"DIR2"		=>	"docs",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"empty_tpl",
									"DOCTPL"	=>	"doc_link"),
				"pdf"	=>	array(	"DIR"		=>	"docs",
									"DIR2"		=>	"docs",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"empty_tpl"),
			// Images
				"ico"	=>	array(	"DIR"		=>	"images",
									"DIR2"		=>	"images",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"icon_link"),
				"png"	=>	array(	"DIR"		=>	"images",
									"DIR2"		=>	"images",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"empty_tpl"),
			// Usecode
				"uc"	=>	array(	"DIR"		=>	"usecode",
									"DIR2"		=>	"usecode",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"finfo",
									"DOCTPL"	=>	"empty_tpl"),
				"dat"	=>	array(	"DIR"		=>	"usecode",
									"DIR2"		=>	"usecode",
									"LNKTPL"	=>	".d_link",
									"NFOTPL"	=>	"empty_tpl",
									"DOCTPL"	=>	"doc_link"),
			);
		
		return $ext_nfo[$extension];
	}
	
	function add_download_link( $file, $extension, $title, $icon, $blurbinfo, $dir )
	{
		global $tpl;
		
		$info = get_file_info($extension);

		if (is_array($file))
		{
			$fname = $dir . "/" . $file["DATFILE"];
			$link = local_link($title, $file["TARGET"] . $file["DATFILE"]);
		}
		else
		{
			$fname = $dir . "/$file.$extension";
			$link = local_link($title, $fname);
		}
		
		if ($check = file_exists($fname)) {
			if (is_array($blurbinfo))
				$blurbinfo = implode(", ", $blurbinfo);
			$tpl->assign("BLURBNFO", $blurbinfo);
			$tpl->parse("DOCBLURB", $info["DOCTPL"]);

			$tpl->assign(
				array(
					"EXT"			=>	$extension,
					"FILE_SIZE"		=>	ceil(filesize($fname)/1024)
				)
			);
			$tpl->parse("FILE_INFO", $info["NFOTPL"]);
			
			if (is_array($icon))
			{
				foreach($icon as $pic)
					$img .= image($title, "$pic.png");
			}
			else
				$img = image($title, "$icon.png");
				
			$tpl->assign(
				array(
					"FILE_LINK"		=>	$link,
					"ICON"			=>	$img,
					"FILE_DATE"		=>	date("H:i",filemtime($fname)),
					"FILE_TIME"		=>	date("Y-m-d",filemtime($fname))
				)
			);
			$tpl->parse("CONTENT", $info["LNKTPL"]);
		}
	}
	
	function make_download_page( $desc_info, $notice_info )
	{
		make_section($desc_info["NAME"]);
		$showicon = $desc_info["SHOWICON"];
		foreach($desc_info["TEXT"] as $i => $text)
			add_text($text, $i == 0 && $showicon, $desc_info["ICON"] . ".png");

		close_section();
		make_box($notice_info["TITLE"], $notice_info["TEXT"], true);
	}
	
	function output_file_links( $files, $icons, $page )
	{
		global $tpl;
		
		$tpl->assign("DOWNLOAD_LINK", "<!-- empty! -->");
		// Add the links to all files:
		if ($page == 0)
		{
			for ($i = 0; $i < count($files); $i++)
			{
				foreach($files[$i] as $file)
					add_download_link( $file["NAME"], $file["EXT"],
						$file["TITLE"], $icons[$i], $file["BLURBNFO"],
						$file["DIR"] );
			}
		}
		else
		{
			foreach($files[$page] as $file)
				add_download_link( $file["NAME"], $file["EXT"],
					$file["TITLE"], $icons[$page], $file["BLURBNFO"],
					$file["DIR"] );
		}
	}
?>
