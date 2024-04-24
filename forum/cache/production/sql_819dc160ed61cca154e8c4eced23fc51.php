<?php exit; ?>
1713994010
SELECT m.*, u.user_colour, g.group_colour, g.group_type FROM (phpbb_moderator_cache m) LEFT JOIN phpbb_users u ON (m.user_id = u.user_id) LEFT JOIN phpbb_groups g ON (m.group_id = g.group_id) WHERE m.display_on_index = 1
260
a:1:{i:0;a:9:{s:8:"forum_id";s:1:"0";s:7:"user_id";s:1:"0";s:8:"username";s:0:"";s:8:"group_id";s:1:"8";s:10:"group_name";s:16:"Exult Developers";s:16:"display_on_index";s:1:"1";s:11:"user_colour";N;s:12:"group_colour";s:6:"6600CC";s:10:"group_type";s:1:"0";}}