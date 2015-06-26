<?php
/*
Template Name: Pano-Editor
*/

if (isset($_GET['return_the_pano'])){
    return_pano_xml($_GET['return_the_pano']);
    die();
} 

if (isset($_GET['registration_js'])){
    return_registration_script();
    die();
}

$pano_id = 1;

// Required panomanager to function
if (isset($_GET['pano_id'])){
  $pano_id = $_GET['pano_id'];
}

// Call the pano function
$pano_script = load_pano($pano_id);

$content_root = content_url();
$pano_editor = WP_PLUGIN_URL . '/vocabulary-plugin/hotspot-editor/hotspot_editor.php';

$deck_id = $_GET['game_id'];
$game_type = '1';
?>
<link href="//cdn.rawgit.com/noelboss/featherlight/1.3.2/release/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.2/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<div id="page">
<script>

    function showMessage(){
      alert("This is your new hotspot!");
    }

    function newHotspot(){
        var mx = krpano.get("mouse.x");
        var my = krpano.get("mouse.y");
        var pt = krpano.screentosphere(mx,my);

        var url = '<?=$pano_editor?>?point_x=' + pt.x + '&point_y=' + pt.y + '&deck_id=' + <?=$deck_id?> + '&game_type=""';

        $.featherlight(url);
    }

    function addHotspot(hotspotName){
      var mx = krpano.get("mouse.x");
      var my = krpano.get("mouse.y");
      var pt = krpano.screentosphere(mx,my);

      var hotspotAddName = "addhotspot("  + hotspotName + ")";
      var hotspotURL     = "set(hotspot[" + hotspotName + "].url,'<?=$content_root?>/panos/1/info.png');";
      var hotspotX       = "set(hotspot[" + hotspotName + "].ath," + pt.x + ");";
      var hotspotY       = "set(hotspot[" + hotspotName + "].atv," + pt.y + ");"; 
      var hotspotScale   = "set(hotspot[" + hotspotName + "].scale,0.5);";
      var hotspotZoom    = "set(hotspot[" + hotspotName + "].zoom,'true');";
      var hotspotOnClick = "set(hotspot[" + hotspotName + "].onclick, 'onClickevent');";

      krpano.call(hotspotAddName);
      krpano.call(hotspotURL);
      krpano.call(hotspotX);
      krpano.call(hotspotY);
      krpano.call(hotspotScale);
      krpano.call(hotspotZoom);
      krpano.call(hotspotOnClick);

    }

    
    // Handle resizing the pano no matter the browser size
    function resize_pano(height, width){
        
        // Create the pano div object
        var panoDiv = document.getElementById("panoDIV");
        
        panoDiv.style.height = height;
        panoDiv.style.width = width;

        var pano = document.getElementById("pano_wrapper");
        pano.addEventListener("dblclick", newHotspot);

    }
    
    
    // On document ready, trigger the pano
    document.addEventListener('DOMContentLoaded',function(){
       var height = (document.getElementById('page').offsetHeight - 20) + "px";
       var width = document.getElementById('page').offsetWidth + "px";

        $("#mission-menu").mmenu({
            slidingSubmenus: false
        });

       resize_pano(height, width);
    });
    
</script>

<div id="pano_wrapper" style="height: 100%; width: 100%">
    <div id="panoDIV"></div>
</div>

</div>

<?php wp_footer(); ?>
<div class="pano_script_div">
  <!-- call the pano -->
  <?php echo $pano_script; ?>
</div>
