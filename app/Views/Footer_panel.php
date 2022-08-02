
    <script src="<?=base_url()?>/../../assets/js/General.js"></script>
    <script src="<?=base_url()?>/../../assets/js/scripts.js"></script>

    <?php
    if(isset($external_scripts)){
      foreach ($external_scripts as $key) {
        echo "<script src=\"$key\"></script> \n";
      }
    }
    
    if(isset($scripts)){
      foreach ($scripts as $key) {
        echo "<script src=\"".base_url()."/../../assets/js/$key\"></script> \n";
      }
    }

    
    ?>

  </body>
</html>