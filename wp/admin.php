<?php
// get plugin url
$plugin_url = plugin_dir_url(__FILE__);
// find file with prefix index- and suffix .js in dist/assets folder
$js_files = glob(__DIR__ . "/dist/assets/index-*.js") ?? [];
// get first file
$index_js = $js_files[0] ?? "";

// get file name
$index_js = basename($index_js);

?>
<div id="app"></div>
<script type="module" src="<?php echo $plugin_url . "dist/assets/$index_js"; ?>"></script>
<script type="module">
window.xp_config = {
    "plugin_url": "<?php echo $plugin_url; ?>",
    "map_tiles_url": "/wp-content/cache/osm-tiles/{s}/{z}/{x}/{y}.png",
    // "map_tiles_url": "https://tile.openstreetmap.org/{z}/{x}/{y}.png",
}
if (pjs && pjs?.store) {
    pjs.store.map.tiles_url = window.xp_config.map_tiles_url;
}

</script>
