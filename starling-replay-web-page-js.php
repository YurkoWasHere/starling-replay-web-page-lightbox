function starling_replaywebpage(atts) {
    var plugin_path = "<?php echo substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])); ?>";

    $url="";
    if (atts.hasOwnProperty('remote_url')) {
      url = atts.remote_url;
    }
    if (atts.hasOwnProperty('media_id')) {
        var xhr = new XMLHttpRequest();
        var url = "<?php echo $_REQUEST["api_url"];?>" + "/wp/v2/media/" + atts.media_id;
        var method = 'GET';
        xhr.open(method, url, false);
        xhr.send();
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            url=response.source_url;
          } else {
            console.error('Request failed with status:', xhr.status);
          }
        
    }

    //Attributes
    height = atts.hasOwnProperty('height') ? atts.height : "400px";
    width = atts.hasOwnProperty('width') ? atts.width: "100%";

    var ret = '<replay-web-page source="' + url + '"';
    ret += ' replayBase="' + plugin_path + "/replay/" + '"';
    ret += ' style="height:' + height + ';width:' + width + '"';
    if (atts.hasOwnProperty('url'))$ret += ' url="' + atts.url + '"';
    if (atts.hasOwnProperty('embed')) ret += ' embed="'.atts.embed + '"';
    ret += '></replay-web-page>';
    return ret;

}
