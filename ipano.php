<?php
/*
Template Name: iPano
*/

?>
<div id="page">

    <style>
        body {
            margin: 0;
            overflow: hidden;
        }
        
        #ppm_viewer{
            width: 100% !important;
            height: 100% !important;
        }

        #panoDIV{
            width: 100% !important;
            height: 100% !important;
        }
    </style>

<div id="pano_wrapper" style="height: 100%; width: 100%">
    <div id="panoDIV">
        <iframe id='ppm_viewer' src='http://bitspacedevelopment.com/pano/'></iframe>
    </div>
</div>

</div>

<?php wp_footer(); ?>