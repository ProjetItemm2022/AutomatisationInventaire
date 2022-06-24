<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="<?php echo e(asset('js/produit.js')); ?>" type="text/javascript">
        < link href = "<?php echo e(asset('css/bootstrap.css')); ?>"
        rel = "stylesheet" / >
            <
            script src = "<?php echo e(asset('js/jquery-3.4.1.min.js')); ?>"
        type = "text/javascript" >
    </script>
    <script src="<?php echo e(asset('js/bootstrap.js')); ?>" type="text/javascript"></script>
    <style>
        body,
        html {
            font-family: "Free Sans";

        }

        .carte {
            border: 5px solid black;
            width: 180px;
            height: 90px;
            text-align: start;
            margin-bottom: 20px;

        }

        b {
            font-size: 42px;
        }

        h2 {
            font-weight: 1000;
        }

    </style>
</head>


<body>

        <?php $__currentLoopData = $boites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h2>
                <div class="col-xs-4 carte">

                    <div style=" position: relative;
        left:4px ; top:5px">
                        <?php echo e(QrCode::encoding('UTF-8')->size(80)->generate(strval($boite->id))); ?>

                        <span>id produit : <?php echo e($boite->produit_id); ?></span>
                    </div>
                </div>
            </h2>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</body>

</html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/qrCode.blade.php ENDPATH**/ ?>