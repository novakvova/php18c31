<?php include "_header.php"; ?>


    <h1>Hello PHP</h1>
    <?php
        session_start();
        $a=12;
        $b=8;
        $c=$a+$b;
        if(isset($_SESSION["id"]))
        {
            echo "<h2> Hello Peter ".$_SESSION["id"]."</h2>";
        }
        
    ?>

<?php include "_footer.php"; ?>
