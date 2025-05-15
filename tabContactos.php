<?php
/*
Archivo:  tabcontactos.php
Objetivo: consulta general sobre contactos y acceso a operaciones ABC
*/

include_once("modelo/Contacto.php");
session_start();

$sErr = "";
$sUsuario = "";
$arrContactos = null;
$oContacto = new Contacto();

/* Verificar que exista sesión */
if (isset($_SESSION["usuario"])) {
    $sUsuario = $_SESSION["usuario"];
    try {
        $arrContactos = $oContacto->buscarTodos();
    } catch (Exception $e) {
        error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
        $sErr = "Error en base de datos, comunicarse con el administrador";
    }
} else {
    $sErr = "Debe iniciar sesión";
}

if ($sErr == "") {
    include_once("cabecera.html");
    include_once("menu.php");
    include_once("aside.html");
} else {
    header("Location: error.php?sError=" . urlencode($sErr));
    exit();
}
?>
<section>
    <h3>Contactos</h3>
    <br>
    <form name="formTablaGral" method="post" action="formulario.php">
        <!--
        <input type="hidden" name="txtClave">
        <input type="hidden" name="txtOpe">
        -->
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Operaciones</th>
            </tr>
            <?php
            if ($arrContactos != null) {
                foreach ($arrContactos as $contacto) {
            ?>
                    <tr>
                        <td><?php echo $contacto->getNombre(); ?></td>
                        <td><?php echo $contacto->getDireccion(); ?></td>
                        <td><?php echo $contacto->getTelefono(); ?></td>
                        <td><?php echo $contacto->getEmail(); ?></td>
                        <?php
                            if (isset($_SESSION["rol"])){
                                if ($_SESSION["rol"]=="1"){   
                        ?>
                        <td>
                             <form method="post" action="formulario.php" class="formEliminar">
                                <input type="hidden" name="txtClave" value="<?php echo $contacto->getId(); ?>">
                                <input type="hidden" name="txtOpe" class="txtOpe" value="">
                                <input type="submit" value="Modificar" id="btnModificar" onclick="this.form.txtOpe.value='m';">
                                <input type="button" value="Eliminar" class="btnEliminar">
                            </form>
                        </td>
                        <?php
			            	} else {
			            ?>
                        <td>
                            <p>Solo Visualizar</p>
                        </td>
                        <?php
			            	}}
			            ?>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr><td colspan="5">No hay contactos registrados</td></tr>
            <?php
            }
            ?>
        </table>

        <br>
        <?php
            if (isset($_SESSION["rol"])){
                 if ($_SESSION["rol"]=="1"){   
        ?>
        <input type="submit" value="Crear nuevo contacto" id="btnAgregar" onclick="txtClave.value='-1'; txtOpe.value='a'">
        <?php
	       	}}
		?>
    </form>
</section>

<?php include_once("pie.html"); ?>