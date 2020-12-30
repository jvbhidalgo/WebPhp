<?php
  session_start();
  include("classes/connection.php");
  include("classes/funcao.class.php");
  include("autoload.html");
  
  $func = new Funcao();
  
  $retorna = '';
  $div = '';
  if (isset($_POST['cada'])){
    
    $login         = $_POST["login"];
    $nome          = $func->limpaEspecial($_POST["nome"]);
    $pass          = $_POST["senha"];
    $email         = $_POST["email"];
    $telefone      = str_replace(' ','',$func->limpaEspecial($_POST["telefone"]));
    $cep           = str_replace(' ','',$func->limpaEspecial($_POST["cep"]));
    $uf            = $_POST["uf"];
    $bairro        = $_POST["bairro"];
    $cidade        = $_POST["cidade"];
    $rua           = $_POST["rua"];
    $numero        = $_POST["numero"];
    $cpass         = $_POST["csenha"];

    $sql = "SELECT usuid FROM usucad WHERE usulogin = :login";
    $result = $con->prepare($sql);
    
    $params = array(
        'login'  => strtoupper($login)
    );
    $result->execute($params);
    $usuario = $result->fetch();

    if (!$usuario){
      
      $sql = "CALL cadastraUsuario(:login,:nome,:email,:telefone,:cep,:rua,:bairro,:cidade,:uf,:numero,:pass)";
      $result = $con->prepare($sql);
      
      $params = array(
        'login'      => $login,
        'nome'       => $nome,
        'email'      => $email,
        'telefone'   => $telefone,
        'cep'        => $cep,
        'rua'        => $rua,
        'bairro'     => $bairro,
        'cidade'     => $cidade,
        'uf'         => $uf,
        'numero'     => $numero,
        'pass'       => $pass
      );
      $result->execute($params);

      echo  ' <div class="modal container" tabindex="-1" role="dialog" style="display:block; width:30%;">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Usuário Cadastrado!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-primary mb-4"><a style="color: white; text-decoration: none;"
                    href="index.php">Ok</a></button>
                    </div>
                  </div>
                </div>
              </div>';
    }
    else
      echo  '<div class="modal container" tabindex="-1" role="dialog" style="display:block; width:30%;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" style="color:red;">Usuário já cadastrado!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-footer">
                  <button class="btn btn-primary mb-4"><a style="color: white; text-decoration: none;"
                  href="cadastro.php">Ok</a></button>
                  </div>
                </div>
              </div>
            </div>';
  }
  include("cadastro.html");
?>