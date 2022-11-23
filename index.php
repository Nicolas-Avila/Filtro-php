<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtros</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php
    // $server = "localhost";
    // $user = "root";
    // $pass = "";

    // $conexion = mysqli_connect($server, $user, $pass) or die("Error de Conexion");
    // $db = mysqli_select_db($conexion, "almacen");
    $conexion= mysqli_connect("localhost","id16711206_nico","!ZN0@(}CdF}k@7Li","id16711206_crud") or DIE("Error");
    ?>

    <form action="#" method="post">
    <fieldset id="form">
    <legend>Almacen</legend>
    <ol>
       <li> <label for="nombre">Nombre</label></li>
        <input type="text" name="nombre" id="nombre">
        <li> <label for="desc">Descripcion</label></li>
        <input type="text" name="desc" id="desc">
        <li> <label for="select">Categoria</label></li>
        <select name="select" id="select">
            <option value="Lacteos">Lacteos</option>
            <option value="Fiambre">Fiambre</option>
            <option value="Latas">Latas</option>
            <option value="Legumbres">Legumbres</option>
        </select>
        <li> <label for="precio">Precio</label> </li>
        <input type="number" name="precio" id="precio">
    </ul>   
    <p align="center"><input type="submit" name="submit" class="btn" value="Agregar"/></p>

        </fieldset>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $nombre = $_POST["nombre"];
        $desc = $_POST["desc"];
        $select = $_POST["select"];
        $precio = $_POST["precio"];

        $insert = "INSERT INTO producto VALUES (null,'$nombre','$desc','$select','$precio')";
        $ejecutar = mysqli_query($conexion, $insert);
        if ($ejecutar) {
            echo "<script>alert('Producto ingresado con exito')</script>";
        }
    }
    ?>
    <div class="formulario">
        <!-- <h1>Filtrar</h1> -->
        <form class="form1" action="" method="get" name="form">

            <select name="Categoria" id="select">
                <option value="todo">Todo</option>
                <option value="Lacteos">Lacteos</option>
                <option value="Fiambre">Fiambre</option>
                <option value="Latas">Latas</option>
                <option value="Legumbres">Legumbres</option>
            </select>
            <select name="orden" id="">
                <option value="">Predeterminado</option>
                <option value="DESC">Mayor a Menor</option>
                <option value="ASC">Menor a Mayor</option>
            </select>
            <input type="submit" name="submit2" value="mostrar">
        </form>

        <form class="form2"  action="#" method="get">
            <label for="">Buscador</label>
            <input type="text" name="buscar" id="buscar">
            <input type="submit" name="submit3" value="Buscar">
        </form>
    </div>

    <div class="producto">
        <?php
        if (isset($_GET['submit2']) && $_GET['Categoria'] != 'todo') {
            $categoria = $_GET['Categoria'];
            $orden = $_GET['orden'];
            $sql = "SELECT * FROM producto WHERE Categoria ='$categoria' ORDER BY Precio $orden ";
        }
        if (isset($_GET['submit2']) && $_GET['Categoria'] == 'todo') {
            $categoria = $_GET['Categoria'];
            $orden = $_GET['orden'];
            $sql = "SELECT * FROM producto ORDER BY Precio $orden ";
        }
        if (!isset($_GET['submit2'])) {
            $sql = "SELECT * FROM producto";
        }
        if (isset($_GET['submit3'])) {
            $buscador = $_GET['buscar'];
            $sql = "SELECT * FROM producto WHERE Categoria LIKE  '%$buscador%' OR Nbr_producto LIKE '%$buscador%'";
        }
        $ejecutar = mysqli_query($conexion, $sql);
        $i = 0; ?>

        <?php
        while ($fila = mysqli_fetch_array($ejecutar)) {
            $id = $fila['Id_producto'];
            $nombre = $fila['Nbr_producto'];
            $desc = $fila['Descripcion'];
            $select = $fila['Categoria'];
            $precio = $fila['Precio'];
            $i++;
        ?>

            <div class="contacto">
                <p><?php echo $nombre; ?></p>
            </div>
            <div class="contacto">
                <p><?php echo $desc; ?></p>
            </div>
            <div class="contacto">
                <p><?php echo $select; ?></p>
            </div>
            <div class="contacto">
                <p><?php echo $precio; ?></p>
            </div>
        <?php '</div>';
        } ?>

</body>

</html>