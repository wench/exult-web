#1 /bin/sh

echo "var static_snapshot_file_details = {" |tee shapshot_file_details.js
grep -o "https://exult.sourceforge.io/snapshots/[^\"]*" download.html | while read p; do
echo "  '$p':  {"|tee -a shapshot_file_details.js
  curl --silent --show-error --head "$p" | sed -r -n "s/(content-length|last-modified): +(.*)/   '\1': '\2',/p" | tee -a shapshot_file_details.js
echo "  }," | tee -a shapshot_file_details.js
  done
echo "};" |tee -a shapshot_file_details.js
