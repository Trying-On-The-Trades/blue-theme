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
$pano_editor = WP_PLUGIN_URL . '/panomanager/hotspot-editor/hotspot_editor.php';

$deck_id = $_GET['game_id'];
?>
<link href="//cdn.rawgit.com/noelboss/featherlight/1.3.2/release/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.2/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<div id="page">
<script>

    function newHotspot(){
        var mx = krpano.get("mouse.x");
        var my = krpano.get("mouse.y");
        var pt = krpano.screentosphere(mx,my);

        var deck_id = "<?=$deck_id?>";

        if(deck_id == "" || deck_id == null){
            var url = '<?=$pano_editor?>?point_x=' + pt.x + '&point_y=' + pt.y + '&pano_id=' + <?=$pano_id?>;
        }else{
            var url = '<?=$pano_editor?>?point_x=' + pt.x + '&point_y=' + pt.y + '&deck_id=' + <?=$deck_id?> + '&pano_id=' + <?=$pano_id?>;
        }

        $.featherlight(url, null, false);
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
