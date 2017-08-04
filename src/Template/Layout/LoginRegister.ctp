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
        <?=
        $this->Html->css(array('../dashboard/bootstrap/css/bootstrap.min.css', '../dashboard/dist/css/AdminLTE.min.css', '../dashboard/plugins/iCheck/square/blue.css'))
        ?>
        <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') ?>
        <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') ?>      
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>      
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">      
        <?php echo $this->fetch('content') ?>

        <?php
        echo $this->Html->script(array('../dashboard/plugins/jQuery/jquery-2.2.3.min.js', '../dashboard/bootstrap/js/bootstrap.min.js', '../dashboard/plugins/iCheck/icheck.min.js'));
        ?>
        <script type="text/javascript">
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
        <script type="text/javascript">
            $('#forgetpass').on("click", function () {
                var email = $('#forgetpassemail').val();
                $.post('<?php echo $base_url; ?>/users/forgetpassword.json', {'email': email}, function (d) {
                    $('.alert-danger').html(d.response.msg);
                    $('.alert-danger').show();
                });
            });
        </script>
    </body>
</html>
