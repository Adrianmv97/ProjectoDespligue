<?php
$accion = $_REQUEST['accion'];
    if($accion == 'php'){
        $languaje = 'php';
    }else if($accion == 'java'){
        $languaje = 'java';
    }
    if (isset($_REQUEST['boton'])){
        $usuario = $_REQUEST["usuario"];
        $comentario = $_REQUEST["comentario"];
        $fecha = date('H:i:s d/m/Y');
        $conexion = mysqli_connect('localhost','root','','commentbox');
        $stmt = $conexion->stmt_init();
        $stmt->prepare("INSERT INTO cB (usuario, comentario, fecha, languaje) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("ssss",$usuario,$comentario,$fecha,$languaje);
        $stmt->execute();
        $conexion->close();
    }
?>
<div class="container-fluid text-center">  
    <form action="#" method="POST">
        <div class="form-group">
            <label for="nombre"></label>
            <input type="text" class="form-control" name="usuario" id="usuario"  placeholder="usuario" required>
        </div>
        <label for="comentario"></label>
        <div class="form-group">
            <textarea rows="4" cols="200" name="comentario" id="comentario"required>
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="boton">Subir Comentario</button>
    </form>
    <div id="padre">
          <?php 
            $conexion = mysqli_connect('localhost','root','','commentbox');
            $stmt = $conexion->stmt_init();
            $stmt->prepare("SELECT usuario, comentario, fecha FROM cB WHERE languaje = ? ORDER BY fecha DESC");
            $stmt->bind_param('s',$languaje);
            $stmt->execute();
            $resultado = $stmt->get_result();
            while($fila = $resultado->fetch_assoc()){
                echo '<div id="hijo"><p>' . $fila['usuario'] . '</p>' .
                    '<p>' . $fila['comentario'] . '</p>' .
                    '<p>' .$fila['fecha'] . '</p></div>';
            }
          ?>  
    </div>
</div>