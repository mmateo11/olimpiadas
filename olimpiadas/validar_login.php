    <?php
    session_start();
    include("includes/conexion.php");

    $correo = $_POST['correo'];
    $clave = trim($_POST['clave']);

    $sql1 = "SELECT * FROM admin WHERE correo = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $correo);
    $stmt1->execute();
    $res1 = $stmt1->get_result();

    if ($row = $res1->fetch_assoc()) {
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['usuario'] = $row['correo'];
            $_SESSION['tipo'] = 'admin';
            header("Location: admin/panel.php");
            exit();
        }
    }

    $sql2 = "SELECT * FROM clientes WHERE correo = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $correo);
    $stmt2->execute();
    $res2 = $stmt2->get_result();

    if ($row = $res2->fetch_assoc()) {
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['usuario'] = $row['correo'];
            $_SESSION['tipo'] = 'cliente';
            header("Location: clientes/inicio.php");
            exit();
        }
    }

    echo "Login incorrecto. <a href='index.php'>Volver</a>";
