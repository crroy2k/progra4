<?php
/* Prueba de GIT*/ 
class MvcController
{

    #LLAMADA A LA PLANTILLA
    #-------------------------------------

    static public function pagina()
    {
        include "views/template.php";
    }

    #ENLACES
    #-------------------------------------

    public static function enlacesPaginasController()
    {
        if (isset($_GET['action'])) {
            $enlaces = $_GET['action'];
        } else {
            $enlaces = "index";
        }

        $respuesta = Paginas::enlacesPaginasModel($enlaces);

        include $respuesta;
    }

    # Registro Usuarios

    public static function registroUsuarioController()
    {
        if (
            isset($_POST["nombre"]) && isset($_POST["password"]) &&
            isset($_POST["email"])
        ) {

            if (!empty($_POST["nombre"]) && !empty($_POST["password"]) && !empty($_POST["email"])) {

                if (
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["nombre"]) &&
                    preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST["password"]) &&
                    preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST["email"])
                ) {

                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $datos = array(
                        "nombre" => $_POST["nombre"],
                        "password" => $password,
                        "email" => $_POST["email"],
                    );

                    $respuesta = Datos::registroUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        echo '<script>
                                        window.location.href = "registro_ok";
                                      </script>';
                    } else {
                        echo '<script>
                                        window.location.href = "registro_error";
                                      </script>';
                    }
                } else {
                    echo '<script>
                                    window.location.href = "registro_error_invalido";
                                    </script>';
                }
            } else {
                echo '<script>
                                window.location.href = "registro_error_vacio";
                              </script>';
            }
        }
    }

    # Ver usuarios
    public static function vistaUsuariosController()
    {

        $respuesta = Datos::vistaUsuariosModel("usuarios");

        foreach ($respuesta as $key => $value) {
            echo '
                        <tr>
                            <td class="text-info font">' . $value["nombre"] . '</td>
                            <td class="text-info font">********</td>
                            <td class="text-info font">' . $value["email"] . '</td>
                            <td>
                                <a href="editar&idEditar=' . $value["id"] . '">
                                    <button class="btn btn-warning">
                                        <i class="fas fa-pencil-alt text-dark">Editar</i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="usuarios&idBorrar=' . $value["id"] . '">
                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash-alt text-dark">Eliminar</i>
                                    </button>
                            
                                </a>
                            </td>
                        </tr>
                    ';
        }
    }

    #Eliminar usuarios

    public static function borrarUsuarioController()
    {

        if (isset($_GET["idBorrar"])) {

            if (!empty($_GET["idBorrar"])) {

                if (preg_match('/^[0-9]{1,20}$/', $_GET["idBorrar"])) {

                    $datos = $_GET["idBorrar"];

                    $respuesta = Datos::borrarUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        echo '<script>
                                     window.location.href = "eliminado_ok";
                                  </script>';
                    } else {
                        echo '<script>
                                     window.location.href = "eliminado_error";
                                  </script>';
                    }
                } else {
                    echo '<script>
                                window.location.href = "eliminarIdUsuario_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "eliminarIdUsuario_error_invalido";
                          </script>';
            }
        }
    }

    #ObtenerId Usuarios Editar
    public static function editarUsuarioController()
    {

        if (isset($_GET["idEditar"])) {

            if (!empty($_GET["idEditar"])) {

                if (preg_match('/^[0-9]{1,20}$/', $_GET["idEditar"])) {

                    $datos = $_GET["idEditar"];

                    $respuesta = Datos::editarUsuarioModel($datos, "usuarios");
                    echo '
                                  <input type="hidden" name="id" value="' . $respuesta["id"] . '" required>
                                  <a class="btn btn-warning returnUsuarios rounded-pill"><i class="fas fa-arrow-left"></i>Volver</a>
                                    
                                  <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                    
                                        <div class="input-group">
                                    
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-warning">
                                                    <i class="fas fa-user text-dark"></i>
                                                </span>
                                            </div>
                                        <input type="text" class="form-control" name="nombre" value="' . $respuesta["nombre"] . '" required>
                                        </div>
                                  </div>
                                    
                                  <div class="form-group">
                                       <label for="pwd">Password:</label>
                                    
                                       <div class="input-group ">
                                    
                                           <div class="input-group-prepend">
                                               <span class="input-group-text bg-warning">
                                                   <i class="fas fa-lock text-dark"></i>
                                               </span>
                                           </div>
                                        <input type="password" class="form-control" name="password" required>
                                        </div>
                                  </div>
                                    
                                  <div class="form-group">
                                       <label for="email">Email:</label>
                                    
                                       <div class="input-group ">
                                    
                                           <div class="input-group-prepend">
                                               <span class="input-group-text bg-warning">
                                                    <i class="fas fa-envelope text-dark"></i>
                                               </span>
                                           </div>
                                           <input type="email"  class="form-control" name="email" value="' . $respuesta["email"] . '" required>
                                       </div>
                                  </div>
                                  <button type="submit" class="btn btn-warning rounded-pill"><i class="fas fa-pencil-alt"></i></button>
                                 ';
                } else {
                    echo '<script>
                               window.location.href = "obtenerIdUpdate_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "obtenerIdUpdate_error_vacio";
                          </script>';
            }
        }
    }

    # Actualizar Usuario
    public static function actualizarUsuarioController()
    {

        if (
            isset($_POST["id"]) && isset($_POST["nombre"]) &&
            isset($_POST["password"]) && isset($_POST["email"])
        ) {

            if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["password"]) && !empty($_POST["email"])) {

                if (
                    preg_match('/^[0-9]{1,20}$/', $_POST["id"]) &&
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["nombre"]) &&
                    preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST["password"]) &&
                    preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST["email"])
                ) {

                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $datos = array(
                        "id" => $_POST["id"],
                        "nombre" => $_POST["nombre"],
                        "password" => $password,
                        "email" => $_POST["email"],
                    );

                    $respuesta = Datos::actualizarUsuarioModel($datos, "usuarios");

                    if ($respuesta == "success") {
                        echo '<script>
                                           window.location.href = "actualizado_ok";
                                          </script>';
                    } else {
                        echo '<script>
                                           window.location.href = "actualizado_error";
                                          </script>';
                    }
                } else {
                    echo '<script>
                                   window.location.href = "editar&idEditar=' . $_GET["idEditar"] . '";
                                  </script>';
                }
            } else {
                echo '<script>
                               window.location.href = "actualizado_error_vacio";
                              </script>';
            }
        }
    }

    # Ingresar Usuario ya registrado
    public static function ingresarUsuarioController()
    {

        if (isset($_POST["nombre"]) && isset($_POST["password"])) {

            if (!empty($_POST["nombre"]) && !empty($_POST["password"])) {

                if (
                    preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $_POST["nombre"]) &&
                    preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST["password"])
                ) {

                    $password = $_POST["password"];

                    $datos = array(
                        "nombre" => $_POST["nombre"],
                        "password" => $password,
                    );

                    $respuesta = Datos::ingresarUsuarioModel($datos, "usuarios");

                    if (
                        $respuesta["nombre"] == $datos["nombre"]
                        && password_verify($password, $respuesta["password"])
                    ) {

                        $_SESSION["usuarioActivo"] = true;
                        $_SESSION["user"] = $respuesta["nombre"];

                        echo '<script>
                                       window.location.href = "ingresar_ok";
                                      </script>';
                    } else {
                        echo '<script>
                                       window.location.href = "ingresar_error";
                                      </script>';
                    }
                } else {
                    echo '<script>
                               window.location.href = "ingresar_error_invalido";
                              </script>';
                }
            } else {
                echo '<script>
                           window.location.href = "ingresar_error_vacio";
                          </script>';
            }
        }
    }

    //ingreso de usuarios sin repetir

    public static function validarUsuarioController($datos)
    {
        $respuesta = 0;
        if (!empty($datos)) {
            if (preg_match('/^[A-Za-z0-9\-\_\.]{3,20}$/', $datos)) {
                $respuesta = Datos::validarUsuariosModel($datos);
                if ($respuesta[0] > 0) {
                    $respuesta = 1;
                } else {
                    $respuesta = 0;
                }
            }
        }
        return $respuesta;
    }
}
