<style>
    body, html{
      font-family: "Free Sans";

    }
    .carte{
      border:5px solid black;
      width: 180px;
      height: 90px;
      text-align: center;
      margin-bottom: 10px;
    }
    b{
      font-size:42px;
    }
    h2{
      font-weight: 1000;
    }
  </style>
  </head>
  <body>


  <h2>
    <div class="col-xs-4 carte">

      <br/>

        <?php echo e($produit->nom); ?>


            <?php
            $qrcode = QrCode::format('png')->size(10*7.5)->generate('O'.$produit->idProduit);
            ?>
            <img style="margin-top: -22px; margin-right:50%" src="data:image/png;base64, <?php echo base64_encode($qrcode); ?>"/>

            <?php echo e($produit->idProduit); ?>



      <p>
      </p>
    </div>
  </h2>


</body>
</html>
    </div>
  </h2>
  </body>
  </html>
<?php /**PATH /var/www/html/CodeLouche/Site/AutomatisationInventaire/resources/views/qrCodedownload.blade.php ENDPATH**/ ?>