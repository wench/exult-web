
class Asset
{
  url: string
  id: number
  node_id: string
  name: string
  label: string
  content_type: string
  state: string
  size: number
  digest: string
  download_count: number
  created_at: string
  updated_at: string
  browser_download_url: string      
};
class Release{
    url: string;
    name: string;
    id: number;
    node_id: string;
    tag_name: string;
    target_commitish: string;
    draft: boolean;
    immutable: boolean;
    prerelease: boolean;
    created_at: string;
    updated_at: string;
    published_at: string;

assets: Asset[];


}
function FindAsset(release: Release, name: string,Predicate?: (Asset)=>boolean):Asset|null
{
    let result: Asset|null = null;
    (release.assets).some(asset => {
        if (!result && asset.name === name && (!Predicate || Predicate(asset)))
        {
            result = asset;
            return true;
        }
    });
    
return result;
}
class Releases
{
    data: Release[];

    constructor(json: string) {     
        this.data = JSON.parse(json);
    };

    FindRelease(draft: boolean, prerelease: boolean,Predicate?: (Release)=>boolean ): Release|null
    {
        let result: Release|null = null;
        (this.data).some(release => {
            if (!result && release.draft === draft && release.prerelease === prerelease && (!Predicate || Predicate(release)))
            {
                result = release;
                return true;
            }
        });
    return result;
    }
}
function TryUpdateRow(release: Release, row: HTMLTableRowElement)
{
    let datetime_cell: HTMLTableCellElement|undefined;
    let size_cell: HTMLTableCellElement | undefined;
    let link_elem: HTMLAnchorElement | null | undefined;
    
    // Iterate over cells in row. Using standard for loop for compatibility with older browsers that don't allow iterating HTMLColleection Objects
    for (let index = 0; index < row.cells.length; index++) {
        let child = row.cells.item(index) as HTMLTableCellElement;

        if (!datetime_cell && child.classList.contains("datetime-column")) { 
            datetime_cell = child as HTMLTableCellElement;
        }
        else if (!size_cell && child.classList.contains("size-column")) {
            size_cell = child as HTMLTableCellElement;
        }
        else if (!link_elem && child.classList.contains("link-column")) {
            link_elem = child.firstElementChild as HTMLAnchorElement;
            // If the first child isn't a anchor tag  
            // Don't do anything as the row is not in the correct format
            if (link_elem.tagName !== 'A')
                return;
        }
    }    
    // If dudn't get all 3 cells do nothing
    if (!datetime_cell || !size_cell || !link_elem)
        return;

    // If not a snapshot download do nothing
    if (link_elem.href.substring(0, 39) !== 'https://exult.sourceforge.io/snapshots/')
    {
        return;
    }

    let asset = FindAsset(release,link_elem.href.substring(39));

    // No asset in the Release matching the download's filename
    if (!asset)
    {
        return
    }
    let datetime = new Date(asset.updated_at);
    datetime_cell.innerHTML = datetime.getFullYear() + '-' + (datetime.getMonth() + 1) + '-' + datetime.getDate() + '&nbsp;' + datetime.getHours() + ':' + datetime.getMinutes();
    
    link_elem.href = asset.browser_download_url;

    size_cell.innerHTML = Math.ceil(asset.size/(1024*1024))+"&nbsp;MB"
}

var releases: Releases;

let request = new XMLHttpRequest();
// The github releases api call by default returns the 30 latest releases
// For exult these will all be snapshots unless an official Release was just made
// Use syncronous updaring if possible souser doesn't see the page update
request.open('GET', 'https://api.github.com/repos/exult/exult/releases',false);
request.setRequestHeader('X-GitHub-Api-Version', '2022-11-28');
request.setRequestHeader('Accept', 'application/vnd.github+json');
request.onload = () => {
    releases = new Releases(request.responseText);

    // Get the latest non draft prerelease that has a name starting with Snapshot
    var Snapshot = releases.FindRelease(false, true, (release: Release) => { return release.name.substring(0, 8) === "Snapshot" });
    if (Snapshot) {
        let table = document.getElementById("download_links") as HTMLTableElement;
        
        // Iterate over table rows. Using standard for loop for compatibility with older browsers that don't allow iterating HTMLColleection Objects
        for (let index = 0; index < table.rows.length;index++ ) {
            TryUpdateRow(Snapshot, table.rows.item(index) as HTMLTableRowElement);
        }


    }
};
request.send();
