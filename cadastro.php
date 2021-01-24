<?php
  session_start();
  include("classes/connection.php");
  include("classes/funcao.class.php");
  include("autoload.html");
  
  $func = new Funcao();
  
  $retorna = '';
  $div = '';

  if (isset($_POST['cada'])){
    
    $tipo          = $_POST["tipo"];
    $nome          = strtoupper($func->limpaEspecial($_POST["nome"]));
    $cep           = str_replace(' ','',$func->limpaEspecial($_POST["cep"]));
    $uf            = $_POST["uf"];
    $bairro        = $_POST["bairro"];
    $cidade        = $_POST["cidade"];
    $rua           = $_POST["rua"];
    $numero        = $_POST["numero"];

    $sql = "SELECT IDCLI FROM CLIENTES WHERE NOMECLI = :nome";
    $result = $con->prepare($sql);
    
    $params = array(
        ':nome'  => strtoupper($nome)
    );
    $result->execute($params);
    $usuario = $result->fetch();

    if (!$usuario){
      
      $sql = "CALL cadastraPessoa(:tipo, :nome,:cep,:rua,:bairro,:cidade,:uf,:numero)";
      $result = $con->prepare($sql);
      
      $params = array(
        'tipo'       => $tipo,
        'nome'       => $nome,
        'cep'        => $cep,
        'rua'        => $rua,
        'bairro'     => $bairro,
        'cidade'     => $cidade,
        'uf'         => $uf,
        'numero'     => $numero
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