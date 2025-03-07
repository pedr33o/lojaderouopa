<!DOCTYPE html>
<html lang="en">

    <?php include "head.php"; ?>

    <body>

        <div id="wrapper">


              <?php include "comum.php"; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">StreetFit</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   Tabela Funcionário
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>NOME</th>
                                                    <th>CPF</th>
                                                    <th>CARGO</th>
                                                    <th>SEXO</th>
                                                   
                                                    <th>#</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
include "cone.php";

// Recebendo os dados do formulário
$nome = isset($_GET['n']) ? $_GET['n'] : '';
$cpf = isset($_GET['c']) ? $_GET['c'] : '';
$cargo = isset($_GET['ca']) ? $_GET['ca'] : '';
$sexo = isset($_GET['sexo']) ? $_GET['sexo'] : '';

// Filtrando os dados de entrada
$nome = filter_var($nome, FILTER_SANITIZE_STRING);
$cpf = filter_var($cpf, FILTER_SANITIZE_STRING);
$cargo = filter_var($cargo, FILTER_SANITIZE_STRING);
$sexo = filter_var($sexo, FILTER_SANITIZE_STRING);

// Consulta SQL usando prepared statement
$sql = "SELECT * FROM tb_funcionario WHERE nome LIKE ? AND cpf LIKE ? AND cargo LIKE ?";
$params = ["%$nome%", "%$cpf%", "%$cargo%"];

// Adiciona o filtro de sexo apenas se um valor for selecionado
if (!empty($sexo)) {
    $sql .= " AND sexo = ?";
    $params[] = $sexo;
}

$stmt = $conecta->prepare($sql);
$stmt->execute($params);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Exibindo os resultados
foreach ($funcionarios as $funcionario) {
    echo "<tr>";
    echo "<td>{$funcionario['id']}</td>";
    echo "<td>{$funcionario['nome']}</td>";
    echo "<td>{$funcionario['cpf']}</td>";
    echo "<td>{$funcionario['cargo']}</td>";
    echo "<td>{$funcionario['sexo']}</td>";
    echo "<td>
              <a href='excluir_funcionario.php?id={$funcionario['id']}' class='btn btn-danger'><i class='fa fa-trash'></i></a>
              <a href='editar_funcionario.php?id={$funcionario['id']}' class='btn btn-warning'><i class='fa fa-edit'></i></a>
          </td>";
    echo "</tr>";
}
?>



                                  
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                   
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                
                   
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>

    </body>

</html>