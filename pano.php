<?php
/*
Template Name: Pano
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

?>
<div id="page">
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<style type="text/css">
  body {
    margin: 0;
    overflow: hidden;
  }
</style>

<script>
    
    
    // Handle resizing the pano no matter the browser size
    function resize_pano(height, width){
        
        // Create the pano div object
        var panoDiv = document.getElementById("panoDIV");
        
        panoDiv.style.height = height;
        panoDiv.style.width = width;
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
