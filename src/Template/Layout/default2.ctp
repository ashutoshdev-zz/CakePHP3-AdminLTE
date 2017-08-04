<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Plait';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css(array('../frontend/css/bootstrap.min.css', '../frontend/css/style.css', '../frontend/css/slider.css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'https://fonts.googleapis.com/css?family=Roboto'));
        ?>
        <?php
        echo $this->Html->script(array('https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'));
        ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body>
        <?= $this->element('Frontend/header2'); ?>
        <?= $this->fetch('content') ?>
        <?= $this->element('Frontend/footer'); ?>
        <?php
        echo $this->Html->script(array('../frontend/js/bootstrap.min.js', '../frontend/js/slider.js'));
        ?>
        <script type="text/javascript">jssor_1_slider_init();</script> 
        <!-- #endregion Jssor Slider End -->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#myModal33").modal('show');
            });
        </script>
        
<!--            <script src=" https://maps.googleapis.com/maps/api/js?key=AIzaSyA5mqpR1K9pkPuK1SkouPLaJavW-kzE-Rs&libraries=places&callback=initMap"></script>-->
       
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
    </body>
</html>
