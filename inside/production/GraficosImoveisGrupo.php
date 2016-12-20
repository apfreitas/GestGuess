<?php
include_once("../../validaLogin.php");
include_once("../../lib/config/functions.php");
include_once("../../lib/config/CRUD.php");




$logged = unserialize($_SESSION['logged']);

$loggedName = $logged->nome . ' ' . $logged->apelido;
$tipoConta = $logged->acessos;
$numeroConta = $logged->conta;
$id_conta = '';
$tabela = 'contabanco';

if (isset($_GET['id'])) {
    $id_conta = $_GET['id'];
    $numeroConta = $logged->conta;
    $instituicao = ($_POST['instituicao']);
    $titular1 = ($_POST['titular1']);
    $titular2 = $_POST['titular2'];
    $cd1nome = $_POST['cd1nome'];
    $cd1numero = $_POST['cd1numero'];
    $cd1rede = $_POST['cd1rede'];
    if (!empty($_POST['cd1validade'])) {
        $cd1validade = date('Y-d-m', strtotime($_POST['cd1validade']));
    } else {
        $cd1validade = "";
    }

    $cd2nome = $_POST['cd2nome'];
    $cd2numero = $_POST['cd2numero'];
    $cd2rede = $_POST['cd2rede'];
    if (!empty($_POST['cd2validade'])) {
        $cd2validade = date('Y-d-m', strtotime($_POST['cd2validade']));
    } else {
        $cd2validade = "";
    }

    $cc3nome = $_POST['cc3nome'];
    $cc3numero = $_POST['cc3numero'];
    $cc3rede = $_POST['cc3rede'];
    $cc3plafon = $_POST['cc3plafon'];
    if (!empty($_POST['cc3validade'])) {
        $cc3validade = date('Y-d-m', strtotime($_POST['cc3validade']));
        var_dump($cc3validade);
    } else {
        $cc3validade = "";
    }

    $cc4nome = $_POST['cc4nome'];
    $cc4numero = $_POST['cc4numero'];
    $cc4rede = $_POST['cc4rede'];
    $cc4plafon = $_POST['cc4plafon'];
    if (!empty($_POST['cc4validade'])) {
        $cc4validade = date('Y-d-m', strtotime($_POST['cc4validade']));
    } else {
        $cc4validade = "";
    }
    $erro = "";

    if ((!empty($instituicao)) && (!empty($titular1))) {

        $editaBanco = updateBanco($id_conta, $numeroConta, $instituicao, $titular1, $titular2, $cd1nome, $cd1numero, $cd1rede, $cd1validade, $cd2nome, $cd2numero, $cd2rede, $cd2validade, $cc3nome, $cc3numero, $cc3rede, $cc3plafon, $cc3validade, $cc4nome, $cc4numero, $cc4rede, $cc4plafon, $cc4validade);

        if ($editaBanco > 0) {


            $erro = '<div class="alert alert-success" style="margin: 0px;" >Registo editado com sucesso.</div>';
            $hide = 'style="display: none;"';
            unset($_POST);
        } else {
            $erro = '<div class="alert alert-danger style="margin: 0px;">Descupe mas não foi possivel editar os dados. </div>';
            $hide = 'style="display: none;"';
            unset($_POST);
        }
    } else {
        header("location: ../../inside/production/page_601.php");
    }
} else if (isset($_POST['banco']) && (empty($id_conta))) {
	
    $numeroConta = $logged->conta;
	$cond = ("conta='$numeroConta' ORDER BY id_contaReg DESC LIMIT 1");   
	$res =  mysqli_fetch_array(select( 'id_contaReg',  $tabela, $cond ));	
	$id_contaReg = 1 + $res['id_contaReg'] ;
	//print_r($id_contaReg);
    $instituicao = ($_POST['instituicao']);
    $titular1 = ($_POST['titular1']);
    $titular2 = $_POST['titular2'];
    $cd1nome = $_POST['cd1nome'];
    $cd1numero = $_POST['cd1numero'];
    $cd1rede = $_POST['cd1rede'];
    if (!empty($_POST['cd1validade'])) {
        $cd1validade = date('Y-d-m', strtotime($_POST['cd1validade']));
    } else {
        $cd1validade = "";
    }

    $cd2nome = $_POST['cd2nome'];
    $cd2numero = $_POST['cd2numero'];
    $cd2rede = $_POST['cd2rede'];
    if (!empty($_POST['cd2validade'])) {
        $cd2validade = date('Y-d-m', strtotime($_POST['cd2validade']));
    } else {
        $cd2validade = "";
    }

    $cc3nome = $_POST['cc3nome'];
    $cc3numero = $_POST['cc3numero'];
    $cc3rede = $_POST['cc3rede'];
    $cc3plafon = $_POST['cc3plafon'];
    if (!empty($_POST['cc3validade'])) {
        $cc3validade = date('Y-d-m', strtotime($_POST['cc3validade']));
    } else {
        $cc3validade = "";
    }

    $cc4nome = $_POST['cc4nome'];
    $cc4numero = $_POST['cc4numero'];
    $cc4rede = $_POST['cc4rede'];
    $cc4plafon = $_POST['cc4plafon'];
    if (!empty($_POST['cc4validade'])) {
        $cc4validade = date('Y-d-m', strtotime($_POST['cc4validade']));
    } else {
        $cc4validade = "";
    }
    $erro = "";

    if ((!empty($instituicao)) && (!empty($titular1))) {	 

		$condSQL= ("conta='$numeroConta', id_contaReg='$id_contaReg', instituicao='$instituicao', titular1='$titular1',titular2='$titular2', cd1nome='$cd1nome', 
		            cd1numero='$cd1numero', cd1rede='$cd1rede', cd1validade='$cd1validade',cd2nome='$cd2nome', cd2numero= '$cd2numero', cd2rede='$cd2rede',
					cd2validade='$cd2validade=',cc3nome='$cc3nome',cc3numero='$cc3numero=', cc3rede='$cc3rede', cc3plafon='$cc3plafon', cc3validade='$cc3validade',
					cc4nome ='$cc4nome', cc4numero='$cc4numero', cc4rede='$cc4rede', cc4plafon='$cc4plafon',cc4validade='$cc4validade'");
		$registoBanco = insert($tabela, $condSQL);

        if ($registoBanco > 0) {


            $erro = '<div class="alert alert-success" style="margin: 0px;" >Registo guardado com sucesso.</div>';
            $hide = 'style="display: none;"';
            unset($_POST);
        } else {
            $erro = '<div class="alert alert-danger style="margin: 0px;">Descupe mas não foi possivel guardar os dados. </div>';
            $hide = 'style="display: none;"';
            unset($_POST);
        }
    } else {
        header("location: ../../inside/production/page_601.php");
    }
}
  
?>

<!DOCTYPE html>
<html lang="pt">
    <head>


<?php
include_once 'header.php'
?>
    </head>

    <body class="nav-md">  

<?php
include 'sidemenu.php';
include 'headerbar.php';
?>    


        <!-- page content -->
        <div class="right_col" role="main">            
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Apresentação Dados </h3>
                    </div>
                </div>
                <br />  
				

                <div class="clearfix"></div>
                <div class="row">
                    <div class="">
                        <div class="x_panel" >
						
                            <div class="x_title">
                                <h2>Formulário de Registo </h2>   
								<div class="clearfix"></div>
							</div>
							<label class="control-label col-md-1" for="imovel" style="margin-top: 6px;"> Imóvel </label>
							<div class="col-md-2 ">
								<select class="item form-control" id="imovel" style="margin-left: -40px;" ></select>                                        
							</div>
							<label class="control-label col-md-1" for="categoria" style="margin-top: 6px;"> Categoria </label>
							<div class="col-md-2 ">
								<select class="item form-control" id="categoria" style="margin-left: -20px;";></select>                                        
							</div>
							<div class="col-md-1 ">
							<button id="refresh" type="submit"  class="btn btn-default btn-xs"  name="refresh" style="margin-left: -20px;margin-top: 6px;" value="banco">Filtrar</button>
							</div>									     						
                          
							<br />
							<div class="x_content">                               
							<div class="">
								<div class="x_panel">
								<div class="x_title">
									<h2>Categorias <small>Custos</small></h2>									
								<div class="clearfix"></div>
								</div>
								<div class="x_content">
								<div class="demo-container" ; >
									<canvas id="mybarChart" width="200" height="100" style="with: 200px; heigth: 100px;"></canvas>
								</div>	
								</div>
								</div>
							</div>
							</div>                                							
                        </div>  
					</div>
				</div>		 


                    <!-- /page content -->
					<?php
					if (empty($erro)){
						include 'footer.php';
					}								


					?>

               </div>
            </div>
<?php
include 'linkscripts.php';
?>   

<!--Scripts registapropriedade-->
<!-- jquery.inputmask Máscara do template-->
<script>
  // Bar chart
      var ctx = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto" , "Setembro" ,"Outubro" , "Novembro" , "Dezembro"],
          datasets: [{
            label: '# of Votes',
            backgroundColor: "#26B99A",
            data: [51, 30, 40, 28, 92, 50, 45]
          },{ 
		    label: '# of Votes',
            backgroundColor: "#28B99B",
            data: [51, 30, 40, 28, 92, 50, 45]
          },{
            label: '# of Votes',
            backgroundColor: "#03586A",
            data: [41, 56, 25, 48, 72, 34, 12]
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

</script>


    


<!--Scripts Gerais -->
<script>
	// initialize the validator function
	validator.message.date = 'not a real date';

	// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
	$('form')
			.on('blur', 'input[required], input.optional, select.required', validator.checkField)
			.on('change', 'select.required', validator.checkField)
			.on('keypress', 'input[required][pattern]', validator.keypress);

	$('.multi.required').on('keyup blur', 'input', function () {
		validator.checkField.apply($(this).siblings().last()[0]);
	});

	$('form').submit(function (e) {

		var submit = true;

		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
			e.preventDefault();
			submit = false;
		}

		if (submit) {
			$('form').reset();
			document.getElementById('#instituicao').style.display = 'none';
			e.preventDefault();
		}
	});
</script>
<!-- Datatables -->
<script>
	$(document).ready(function () {	         
		$('#datatable').dataTable(); 

	});
</script>


<script>



function carregaUrl() {
	window.history.pushState(null, null, "registoBanco.php");
}

function editaDados(ide) {

/*window.history.pushState(null, null, "registoBanco.php?ed=" + ide); */
	window.location.href = "registoBanco.php?ed=" + ide;

}

function refreshPagina() {
	window.location.href = "registoBanco.php"
}

function limpaForm() {
	var elements = document.getElementsByTagName("input");
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].type == "text") {
				lements[i].value = "";
				
			}else if (elements[i].type == "radio") {
						elements[i].checked = false;
			}
			else if (elements[i].type == "checkbox") {
						elements[i].checked = false;
			}
			else if (elements[i].type == "select") {
					elements[i].selectedIndex = 0;
			}
		}
}


function loadAjaxDados(idconta, idcontaReg) {

	var dados = {
		id_conta: idconta,
		id_contaReg: idcontaReg
	};

		$.ajax({
			type: "POST",
			url: '../lib/config/partialDadosBanco.php',
			data: dados,
			dataType: 'json',
			success: function (data, textStatus, jqXHR){
					$('#instituicao').val(data[3]);
					$('#titular1').val(data[4]);
					$('#titular2').val(data[5]);
					$('#cd1nome').val(data[6]);
					$('#cd1numero').val(data[7]);
					$('#cd1rede').val(data[8]);
					if (data[9] != "0000-00-00") {
						$('#cd1validade').val(data[9]);
					}
					$('#cd2nome').val(data[10]);
					$('#cd2numero').val(data[11]);
					$('#cd2rede').val(data[12]);
					if (data[13] != "0000-00-00") {
						$('#cd2validade').val(data[13]);
					}
					$('#cc3nome').val(data[14]);
					$('#cc3numero').val(data[15]);
					$('#cc3rede').val(data[16]);
					if (data[17] != "0") {
						$('#cc3plafon').val(data[17]);
					}
					if (data[18] != "0000-00-00") {
					$('#cc3validade').val(data[18]);
					}
					$('#cc4nome').val(data[19]);
					$('#cc4numero').val(data[20]);
					$('#cc4rede').val(data[21]);
					if (data[22] != "0") {
						$('#cc4plafon').val(data[22]);
					}
					if (data[23] != "0000-00-00") {
						$('#cc4validade').val(data[23]);
					}
					$("html, body").animate({scrollTop: 0}, 1000); //ir para o topp da página 1000 é a velocidade
					window.history.pushState(null, null, "registoBanco.php?id=" + data[0]); /*passa para o url o val do id*/
			},
			error: function (jqXHR, textStatus, errorThrown){

					console.log(textStatus);
			}
		});
}

</script>

<?php
if (isset($_GET['D'])) {
    $delnome = $_GET['D'];


    echo "<script>$(window).load(function (){ $('#myModal').modal('show');});</script>";
}
?>


            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="carregaUrl();"  >&times;</button>
                            <h4 class="modal-title" id="myModalLabel"><strong>Sucessso!</strong></h4>
                        </div>
                        <div class="modal-body">
                            <p>Eleminou da sua conta <strong><?php echo $numeroConta; ?></strong>  a instiuição <strong><?php echo $delnome; ?></strong></p>    

                        </div>    
                    </div>
                </div>
            </div>
        </div>                   




    </body>
</html>

