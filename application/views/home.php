<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TODO List App</title>

    <!-- Bootstrap Core CSS -->
    <link href="static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="static/css/simple-sidebar.css" rel="stylesheet">

    <style type="text/css">
        th, .table-center{
            text-align: center;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="/">
                        TODO Menu
                    </a>
                </li>
                <li>
                    <a href="/">Tareas Pendientes</a>
                </li>
                <li>
                    <a href="nueva">Crear Nueva Tarea</a>
                </li>                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div style="display:none">
            <input type="hidden" 
            name=<?php echo $this->security->get_csrf_token_name() ?> 
            value=<?php  echo $this->security->get_csrf_hash()?> >
            </div>
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>TODO List</h1>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped  table-center">
                                    <tr>
                                        <th>Creado el</th>
                                        <th>Tarea</th>
                                        <th>Observaciones</th>
                                        <th>Listo</th>
                                        <th>Opciones</th>
                                    </tr>
                                    <tbody>
                                    <?php 
                                    $this->load->helper('date');
                                    $datestring = "d / m / Y";

                                    foreach ($rows->result_array() as $r)
                                    {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo date( $datestring, strtotime($r['fecha_creacion']));
                                        echo "</td>";
                                        echo "<td>";
                                        echo $r['titulo'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $r['observaciones'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo '<input class = "pendiente" type="checkbox" ';

                                        if( $r['pendiente'] === 'f'){
                                            echo 'checked';
                                        }
                                        echo " id='";
                                        echo $r['id'];
                                        echo "'>";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "<a class='btn btn-sm btn-danger eliminar-tarea' id='";
                                        echo $r['id'];
                                        echo "'>";
                                        echo "<i class='glyphicon glyphicon-trash'></i>
                                        </a>";
                                        echo "</td>";                                        
                                        echo "</tr>";
                                    };
                                    ?>          
                                    </tbody>
                                </table>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="static/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="static/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <script type="text/javascript">
    $(function(){

        $.ajaxSetup({
            data: {
                csrf_token: $('input[name="csrf_token"]').val()
            }
        });

        $('.eliminar-tarea').click(function(){
            var id = $(this).attr('id');
            var me = this;
            $.ajax({
              type: "POST",
              url: "/eliminar",
              data: { 'id': id},
              success: function(d){
                $(me).parent().parent().fadeOut(300).remove();
              },
              error: function(d){
                console.log(d);
              },
            });
        });

        $('.pendiente').change(function(){
            var id = $(this).attr('id');
            var nv = $(this).prop('checked')? 'false' : 'true';
            console.log(nv);
            $.ajax({
              type: "POST",
              url: "/cambiar",
              data: { 'pendiente': nv, 'id': id},
              success: function(d){
               console.log(d);
              },
              error: function(d){
                console.log(d);
              },
            });

        });
    });
    </script>

</body>

</html>
