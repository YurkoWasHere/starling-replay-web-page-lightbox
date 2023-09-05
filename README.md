# starling-replay-web-page

*This is a proof of concept plugin for WordPress to display embeded WACZ files.*

This plugin uses wordpress's [shortcodes](https://www.smashingmagazine.com/2012/05/wordpress-shortcodes-complete-guide/) to [embed a replayweb.page](https://replayweb.page/docs/embedding) component into wordpres.

This plugin will 
- enable `.WACZ` file uploads for WordPress
- add ui.js from the CND to show replayweb.page components
- host a `/replay` folder with `sw.js` pointing to the CND and map it correctly

Usage

Link to a WACZ file hosted somewhere else  
`[wacz_url url="http://someurl.com/somefile.wacz"]`

Refrence a WACZ file uploaded to WordPress  
`[wacz_url media_id="56"]`

`media_id` is the `id` WordPress associates with the media once uploaded. You can get this number by opening the wacz file in WordPresses `Media Library` then looking at the address bar. You will see the end of the address ass `id=49`. in this case the media_id is `49`.

## Using this plugin

Clone the repo, then place all files in folder called `starling-replay-web-page`. Zip the `starling-replay-web-page` folder. Upload to WordPress's plugin section.
