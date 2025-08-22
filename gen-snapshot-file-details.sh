#! /bin/sh
 #  gen-snapshot-file-details.sh - Script to prefetch Snapshot File Details from sourceforge for download page
 #
 #  Copyright (C) 2025 The Exult Team
 #
 #  This program is free software; you can redistribute it and/or modify
 #  it under the terms of the GNU General Public License as published by
 #  the Free Software Foundation; either version 2 of the License, or
 #  (at your option) any later version.
 #
 #  This program is distributed in the hope that it will be useful,
 #  but WITHOUT ANY WARRANTY; without even the implied warranty of
 #  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 #  GNU General Public License for more details.
 #
 #  You should have received a copy of the GNU General Public License
 #  along with this program; if not, write to the Free Software
 #  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 
echo "var static_snapshot_file_details = {" |tee shapshot_file_details.js
grep -o "https://exult.sourceforge.io/snapshots/[^\"]*" download.html | while read p; do
  echo "  '$p':  {"|tee -a shapshot_file_details.js
  curl --silent --show-error --head "$p"  | sed -r -n "s/(content-length|last-modified): +([^\r]+)\r?$/   '\1': '\2',/p" | tee -a shapshot_file_details.js
  echo "  }," | tee -a shapshot_file_details.js
done
echo "};" |tee -a shapshot_file_details.js
