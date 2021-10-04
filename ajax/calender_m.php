<?php
if (isset($_POST['op'])) {
    $fh = fopen('../fechas.txt', 'a');
    fclose($fh);
    unlink('../fechas.txt');
    $nombre_archivo = "../fechas.txt";
    switch ($_POST['op']) {
        case 1:
            $nombre_archivo = "../fechas.txt";
            $n_fecha = $_POST['year']."-".$_POST['mes']."-".$_POST['dia'];
            echo "\n>>".$n_fecha;
            $nuevafecha = $n_fecha;
            for ($i=0; $i < 16 ; $i++) { 
                $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                if(file_exists($nombre_archivo))
                {
                    $mensaje = "El Archivo $nombre_archivo se ha modificado";
                }
                else
                {
                    $mensaje = "El Archivo $nombre_archivo se ha creado";
                }
                $nuevafecha = $nuevafecha."\n";
                if($archivo = fopen($nombre_archivo, "a"))
                {
                    if(fwrite($archivo, $nuevafecha))
                    {
                        echo "Se ha ejecutado correctamente";
                    }
                    else
                    {
                        echo "Ha habido un problema al crear el archivo";
                    }
             
                    fclose($archivo);
                }
             
            }
            break;
        
        case 2:
                $n_fecha = $_POST['ann']."-".$_POST['mes']."-".$_POST['dia'];
                echo "\n>>".$n_fecha;
                $nuevafecha = $n_fecha;
                $nuevafecha = strtotime ( '-30 day' , strtotime ( $nuevafecha ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                for ($i=0; $i < 16 ; $i++) { 
                    $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
                    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                    if(file_exists($nombre_archivo))
                    {
                        $mensaje = "El Archivo $nombre_archivo se ha modificado";
                    }
                    else
                    {
                        $mensaje = "El Archivo $nombre_archivo se ha creado";
                    }
                    $nuevafecha = $nuevafecha."\n";
                    if($archivo = fopen($nombre_archivo, "a"))
                    {
                        if(fwrite($archivo, $nuevafecha))
                        {
                            echo "Se ha ejecutado correctamente";
                        }
                        else
                        {
                            echo "Ha habido un problema al crear el archivo";
                        }
                 
                        fclose($archivo);
                }
            }
            break;
            case 3:
                $n_fecha =date("Y-m-j");
                echo "\n>>".$n_fecha;
                $nuevafecha = $n_fecha;
                $nuevafecha = strtotime ( '-8 day' , strtotime ( $nuevafecha ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                for ($i=0; $i < 16 ; $i++) { 
                        if(file_exists($nombre_archivo))
                        {
                            $mensaje = "El Archivo $nombre_archivo se ha modificado";
                        }
                        else
                        {
                            $mensaje = "El Archivo $nombre_archivo se ha creado";
                        }
                        $nuevafecha = $nuevafecha."\n";
                        if($archivo = fopen($nombre_archivo, "a"))
                        {
                            if(fwrite($archivo, $nuevafecha))
                            {
                                echo "Se ha ejecutado correctamente";
                            }
                            else
                            {
                                echo "Ha habido un problema al crear el archivo";
                            }
                     
                            fclose($archivo);
                    }
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
                        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                }
                break;
    }
}
 ?>