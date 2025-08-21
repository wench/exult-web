function FindAsset(release, name, Predicate) {
    var result = null;
    (release.assets).some(function (asset) {
        if (!result && asset.name === name && (!Predicate || Predicate(asset))) {
            result = asset;
            return true;
        }
    });
    return result;
}
var Releases = /** @class */ (function () {
    function Releases(json) {
        this.data = JSON.parse(json);
    }
    ;
    Releases.prototype.FindRelease = function (draft, prerelease, Predicate) {
        var result = null;
        (this.data).some(function (release) {
            if (!result && release.draft === draft && release.prerelease === prerelease && (!Predicate || Predicate(release))) {
                result = release;
                return true;
            }
        });
        return result;
    };
    return Releases;
}());
function PaddedNumberToString(num)
{
    if (num < 10) return '0' + num;
    return num.toString();
}
function UpdateDateTimeSize(datetime_cell, newdate, size_cell, newsizebytes)
{
    var datetime = new Date(newdate.replace ('GMT','UTC'));
    datetime_cell.innerHTML = datetime.getFullYear() + '-' + PaddedNumberToString(datetime.getMonth() + 1) + '-' + PaddedNumberToString(datetime.getDate()) + '&nbsp;' + datetime.getHours() + ':' + PaddedNumberToString(datetime.getMinutes());
    size_cell.innerHTML = Math.ceil(newsizebytes / (1024 * 1024)) + "&nbsp;MB";    
}
// This global gets set by shapshot_file_details.js
var static_snapshot_file_details;
function TryUpdateSnapshotRowWithStaticFallback(datetime_cell, size_cell, link_elem)
{
    if (static_snapshot_file_details && static_snapshot_file_details.hasOwnProperty(link_elem.href) &&
        static_snapshot_file_details[link_elem.href].hasOwnProperty('last-modified') &&
        static_snapshot_file_details[link_elem.href].hasOwnProperty('content-length')) {
        UpdateDateTimeSize(datetime_cell, static_snapshot_file_details[link_elem.href]['last-modified'], size_cell, static_snapshot_file_details[link_elem.href]['content-length']);
    }
}

function TryUpdateSnapshotRowWithHTTPHEAD(datetime_cell, size_cell, link_elem)
{
    if (fetch)
    {
        fetch(link_elem.href, {
            method: 'HEAD',
        }).then((Response)=>
        {
            if (!Response.ok || !Response.headers.has('last-modified') || !Response.headers.has('content-length')) {
                TryUpdateSnapshotRowWithStaticFallback(datetime_cell, size_cell, link_elem);
            }
            else {
                UpdateDateTimeSize(datetime_cell, Response.headers.get('last-modified'), size_cell, Response.headers.get('content-length'));
            }

        }).catch((resason) => {
            TryUpdateSnapshotRowWithStaticFallback(datetime_cell, size_cell, link_elem)
            
        });
    }
    else {
        TryUpdateSnapshotRowWithStaticFallback(datetime_cell, size_cell, link_elem)
    }
}
// Update a download link row
// Only updates the row if it has the 
// datetime, size and link columns
// The link column must contain a single A tag with a url that starts with https://exult.sourceforge.io/snapshots/
// It matches the download filename with an Asset in the GitHub Release. If there is a match it fills in the DateTime cell
// Changes the download url to the asset's download url on github and Updates the Size cell 
function TryUpdateSnapshotRow(release, row) {
    var datetime_cell;
    var size_cell;
    var link_elem;
    // Iterate over cells in row. Using standard for loop for compatibility with older browsers that don't allow iterating HTMLColleection Objects
    for (var index = 0; index < row.cells.length; index++) {
        var child = row.cells.item(index);
        if (!datetime_cell && child.classList.contains("datetime-column")) {
            datetime_cell = child;
        }
        else if (!size_cell && child.classList.contains("size-column")) {
            size_cell = child;
        }
        else if (!link_elem && child.classList.contains("link-column")) {
            link_elem = child.firstElementChild;
            // If the first child isn't an anchor tag or not link to a snapshot file
            // Don't do anything as the row is not in the correct format
            if (link_elem.tagName !== 'A' || link_elem.href.substring(0, 39) !== 'https://exult.sourceforge.io/snapshots/')
                return;
        }
    }
    // If didn't get all 3 cells do nothing
    if (!datetime_cell || !size_cell || !link_elem)
        return;
    var asset = FindAsset(release, link_elem.href.substring(39));
    // If no asset in the Release matching the download's filename do nothing
    if (!asset) {
        TryUpdateSnapshotRowWithHTTPHEAD(datetime_cell, size_cell, link_elem);
        return;
    }
    link_elem.href = asset.browser_download_url;
    UpdateDateTimeSize(datetime_cell,asset.updated_at,size_cell,asset.size)
}
var releases;
var request = new XMLHttpRequest();
// Ask for 4 releases in the API call to github This should be enough to ensure we get the latest snapshot
// Usually the snapshot wull be the first Release but if there was An Official Release after the latest snapshot, 
// the snapshot will be second
// Ask for 4 releases just to be safe 
request.open('GET', 'https://api.github.com/repos/exult/exult/releases?per_page=4', true);
request.setRequestHeader('X-GitHub-Api-Version', '2022-11-28');
request.setRequestHeader('Accept', 'application/vnd.github+json');
request.onload = function () {
    releases = new Releases(request.responseText);
    // Get the latest non draft prerelease that has a name starting with Snapshot
    var Snapshot = releases.FindRelease(false, true, function (release) { return release.name.substring(0, 8) === "Snapshot"; });
    if (Snapshot) {
        var table = document.getElementById("download_links");
        // Iterate over table rows. Using standard for loop for compatibility with older browsers that don't allow iterating HTMLColleection Objects
        for (var index = 0; index < table.rows.length; index++) {
            TryUpdateSnapshotRow(Snapshot, table.rows.item(index));
        }
    }
};
request.send();
