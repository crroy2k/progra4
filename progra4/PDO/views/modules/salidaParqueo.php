<?php

if (isset($_SESSION)) {
    if (!$_SESSION["usuarioActivo"]) {
        header("location:ingresar_error");
        exit();
    } else {
    }
}

?>



<div style=" margin-left: 320px">
    <h1>Salida de parqueo</h1>

    <div class="d-flex justify-content-center text-center">
        <form method="post" class="p-5 bg-light">

            <?php

            $salida = new MvcController();
            $salida->salidaParqueoController();
         


            if (isset($_GET["action"])) {
                if ($_GET["action"] == "salidaParqueo&id") {
                    echo '<div class="alert alert-danger flagDelete text-dark mt-2 text-center">Invalidacion durante la actualizacion</div>';
                }
            }

            ?>
            <button type="submit" onclick="borrarParqueoController();" class="btn btn-danger rounded-pill"><i class="fas fa-pencil-alt"></i>Confirmar salida</button>
        </form>
    </div>
</div>