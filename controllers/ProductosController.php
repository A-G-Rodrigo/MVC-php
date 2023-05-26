<?php

class ProductosController {

    function __construct() {
        $this->model = new ProductosModel();
    }

    function index() {
        $vista = new View();
        $vista->paginas = 0;
        $vista->activePage = 1;
        $vista->classComprarEnlace = '';
        $autenticado = isset($_SESSION["autenticado"]);
        if ($autenticado) {
            $rol = $_SESSION["rol"];
            $vista->classEnlaces = $rol !== 'administrador' ? 'ocultar' : '';
            $vista->classComprarEnlace = $rol !== 'administrador' ? '' : 'ocultar';
        } else {
            $vista->classEnlaces = 'ocultar';
            $vista->classComprarEnlace = 'ocultar';
        }
        if (isset($_GET["busqueda"]) && $_GET["busqueda"] !== '') {
            $productos = $this->model->getProductosByBusqueda($_GET["busqueda"]);
        } else {
            $page = 1;
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
                $vista->activePage = $page;
            }
            $productos = $this->model->getProductosByPage($page);
            $paginas = $this->model->getNumeroPaginasTotales();
            $vista->paginas = $paginas;
        }

        $vista->productos = $productos;
        $vista->url_nuevo = Config::URL_BASE . "/productos/nuevo";
        $vista->render('productos');
    }

    function info(int $id_producto) {
        $producto = $this->model->getProducto($id_producto);
        if (!is_null($producto)) {
            $vista = new View();
            $vista->producto = $producto;
            $vista->url_back = Config::URL_BASE . '/productos';
            $vista->render('productos_info');
        }
    }

    function nuevo() {
        if (!($_SESSION["autenticado"]
            && $_SESSION["rol"] === 'administrador')) {
            header("location: " . Config::URL_BASE);
        }
        $vista = new View();
        $vista->errores = [];
        $vista->url_back = Config::URL_BASE . '/productos';
        try {
            if (isset($_POST["enviar"])) {
                $valido = new ProductoFormValidator($_POST);
                if ($valido->isOK()) {
                    $producto = new Producto($_POST);

                    /// TRATAR IMAGEN
                    if ($_FILES["imagen"]["name"] !== "") {
                        $tmp = $_FILES["imagen"]["tmp_name"];
                        $name = $_FILES["imagen"]["name"];
                        $size = $_FILES["imagen"]["size"];
                        $type = $_FILES["imagen"]["type"];
                        if ($type !== "image/jpeg" && $type !== 'image/png') {
                            $vista->errores["imagen"] = "La imagen solo puede ser del tipo JPEG o PNG.";
                        }
                        if ($size > 100000) {
                            $vista->errores["imagen"] = "La imagen no puede pesar mas de 100KB.";
                        }
                        if (empty($vista->errores)) {
                            $path = new ConfigPath();
                            $destino = $path->path_imagenes . "/" . $name;
                            $ok = move_uploaded_file($tmp, $destino);
                            if ($ok) {
                                $producto->setNombreImagen($name);
                            }
                        }
                    }
                    if (empty($vista->errores)) {
                        $id = $this->model->createProducto($producto);
                        $_POST = [];
                    }
                }
            }
        } catch (ProductoFormValidatorException $e) {
            $errores = $e->getMessagesErrores();
            $vista->errores = $errores;
        } finally {
            $vista->render('productos_new');
        }
    }

    function edit(string $id_producto) {
        if (!($_SESSION["autenticado"]
            && $_SESSION["rol"] === 'administrador')) {
            header("location: " . Config::URL_BASE);
        }
        if (!is_numeric($id_producto)) {
            header("location: " . Config::URL_BASE . "/productos");
        }
        $vista = new View();
        $vista->errores = [];
        $vista->url_back = Config::URL_BASE . '/productos';
        try {
            $productoOld = $this->model->getProducto($id_producto);
            if (is_null($productoOld)) {
                header("location: " . Config::URL_BASE . "/productos");
            }
            if (isset($_POST["enviar"])) {
                $valido = new ProductoFormValidator($_POST);
                if ($valido->isOK()) {
                    $producto = new Producto($_POST);
                    $producto->setIdProducto($id_producto);
                    $producto->setNombreImagen($productoOld->imagen);
                    /// TRATAR IMAGEN
                    if ($_FILES["imagen"]["name"] !== "") {
                        $tmp = $_FILES["imagen"]["tmp_name"];
                        $name = $_FILES["imagen"]["name"];
                        $size = $_FILES["imagen"]["size"];
                        $type = $_FILES["imagen"]["type"];
                        if ($type !== "image/jpeg" && $type !== 'image/png') {
                            $vista->errores["imagen"] = "La imagen solo puede ser del tipo JPEG o PNG.";
                        }
                        if ($size > 100000) {
                            $vista->errores["imagen"] = "La imagen no puede pesar mas de 100KB.";
                        }
                        if (empty($vista->errores)) {
                            $path = new ConfigPath();
                            $destino = $path->path->imagenes . "/" . $name;
                            $ok = move_uploaded_file($tmp, $destino);
                            if ($ok) {
                                $producto->setNombreImagen($name);
                                $file = $path->path_imagenes . "/" . $productoOld->imagen;
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                            }
                        }
                    }
                    if (empty($vista->errores)) {
                        $ok = $this->model->updateProducto($producto);
                        if ($ok) {
                            header("location: " . Config::URL_BASE . "/productos");
                        }
                    }
                }
            } else {
                $_POST = [
                    "nombre" => $productoOld->nombre,
                    "stock" => $productoOld->stock,
                    "marca" => $productoOld->marca,
                    "precio" => $productoOld->precio,
                    "categoria" => $productoOld->categoria,
                    "descripcion" => $productoOld->descripcion,
                    "peso" => $productoOld->peso
                ];
                $vista->imagen = $productoOld->imagen;
            }
        } catch (ProductoFormValidatorException $e) {
            $errores = $e->getMessagesErrores();
            $vista->errores = $errores;
        } finally {
            $vista->render('productos_edit');
        }
    }

    function delete(string $id_producto) {
        if (!($_SESSION["autenticado"]
            && $_SESSION["rol"] === 'administrador')) {
            header("location: " . Config::URL_BASE);
        }
        if (!is_numeric($id_producto)) {
            header("location: " . Config::URL_BASE . "/productos");
        }
        $producto = $this->model->getProducto($id_producto);
        if (is_null($producto)) {
            header("location: " . Config::URL_BASE . "/productos");
        }
        $vista = new View();
        $vista->url_delete = config::URL_BASE
            . "/productos/deletetotal/$id_producto";
        $vista->producto = $producto;
        $vista->render('productos_delete');
    }

    function deletetotal(string $id_producto) {
        if (!($_SESSION["autenticado"]
            && $_SESSION["rol"] === 'administrador')) {
            header("location: " . Config::URL_BASE);
        }
        if (!is_numeric($id_producto)) {
            header("location: " . Config::URL_BASE . "/productos");
        }
        try {
            $productoOld = $this->model->getProducto($id_producto);
            $ok = $this->model->deleteProducto($id_producto);
            if ($ok) {
                $path = new ConfigPath();
                $file = $path->path_imagenes . "/" . $productoOld->imagen;
                if (file_exists($file)) {
                    unlink($file);
                }
                header("location: " . Config::URL_BASE . "/productos");
            }
        } catch (MySqlDBException $e) {
            echo $e->getMessage();
            echo "<br><a href='" . Config::URL_BASE . "/productos'>Volver</a>";
        }
    }
}
