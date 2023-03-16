<?php
/**
 * Template part for displaying posts
 *
 *
 * @subpackage techup
 * @since 1.0 
 */

//include administrative functions
require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');
require_once( ABSPATH . '/wp-includes/PHPMailer/PHPMailer.php');
use PHPMailer\PHPMailer\PHPMailer;

// Global data
$success = true;

//get permalink with path
$url = get_permalink();
			
//disemble the url to names of categories
$catUrl = explode("/",$url, -1);
$chunks = (ENVIRONMENT=='local' ? 5 : 4);
$fullcomandaname = $catUrl[$chunks+1].".ods";
$folderUrl = get_site_url() . "/wp-content/uploads/acord-marc/";

//get chunks
$amyear = $catUrl[$chunks];
$acordmarc = str_replace("-"," ",$amyear);
$acordmarc = ucwords($acordmarc);
$lot = get_the_title();

$msg = "";
$code = "";
$school = "";
$person = "";
$phone = "";
$email = "";
$description = "";

//chech chaptcha when user submit form
if(isset($_POST['submit'])) {
	
	$ok = true;

	if (ENVIRONMENT != 'local') {
		$data = array(
			'secret' => SECRET_CAPTCHA,
			'response' => $_POST['h-captcha-response']
		);
		$verify = curl_init();
		curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
		curl_setopt($verify, CURLOPT_POST, true);
		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($verify);
		$responseData = json_decode($response);
		$ok = $responseData->success;
	}

	if($ok) {
		//Here put code for form processing after captcha is accepted 
		// Form connection
		if(isset($_POST)){
			$subject = $acordmarc. "->".$lot;
			$code = $_POST['code'];
			$school = $_POST['school'];
			$person = $_POST['person'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$fullComandaFile = $_FILES["fullcomanda"]["name"];
			$memoJustFile = $_FILES["memoriajustificativa"]["name"];
			$dispoFonsFile = $_FILES["disponibilitatfons"]["name"]; 

			$fcType = pathinfo($fullComandaFile, PATHINFO_EXTENSION);
			$mjType = pathinfo($memoJustFile, PATHINFO_EXTENSION);
			$dfType = pathinfo($dispoFonsFile, PATHINFO_EXTENSION);

			if ($fcType != 'pdf' || $mjType != 'pdf' || $dfType != 'pdf'){
				$success = false;
				$msg = "Algún dels arxius no és un PDF";
			}
			
			if ($success) {
				//Send email to RT
				$mail = new PHPMailer();
				$mail->isSendmail();
				$mail->setFrom($email, $person);
				$mail->addAddress(EMAIL_CAU_EDUCACIO, 'CAU Educació');

				$mail->Subject = $subject;
				$mail->isHTML(true);
				$mail->Body = '<h2>Formulari</h2> 
					<p><b>Formulari:</b>[ACORD MARC]</p> 
					<p><b>Codi del centre:</b> '.$code.'</p> 
					<p><b>Nom coordinador:</b> '.$person.'</p> 
					<p><b>Telèfon centre:</b><br/>'.$phone.'</p> 
					<p><b>Email:</b><br/>'.$email.'</p>
					<p><b>Contracte:</b><br/>'.$acordmarc.'</p>';

				$mail->addAttachment($_FILES['fullcomanda']['tmp_name'], $_FILES['fullcomanda']['name']);
				$mail->addAttachment($_FILES['memoriajustificativa']['tmp_name'], $_FILES['memoriajustificativa']['name']);
				$mail->addAttachment($_FILES['disponibilitatfons']['tmp_name'], $_FILES['disponibilitatfons']['name']);

				// Send email
				if (ENVIRONMENT != 'local') {				
					$result = $mail->send();
					if ($result){
						$success = true;
						$msg = "Email enviat correctament";
					} else {
						$success = false;
						$msg = "Error en l'enviament del mail. Torna a intentar-ho.";
					}
				} else {
					$msg = "Entorn de prova. Missatge correcte";
				}
			}

		} else {
			$success = false;
			$msg = "Error inesperat. Torna a intentar-ho.";
		}
	} else {
		//here is code for captcha fail
		$success = false;
		$msg = "Error de captcha";
	}
}
?>

<div id="mt-0 post-<?php the_ID(); ?>" <?php post_class(); ?>>
<article class="mt-0">
	<div class="text-center">
	  <?php
		
        if( is_singular() ){
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'techup' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
        }else{
            the_excerpt();
        }
		
		?>
		
		<!--adding javascript library-->
		<script src='https://js.hcaptcha.com/1/api.js' async defer></script>
		
		<!-- button to go back -->
		<div class="text-left" >
			<a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
		</div>

		<!-- Form -->
		<div class="row">
			<div class="col-12">
				<?php if ($msg != '') { ?>
				<div class="alert" style="background-color:green">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">
						<?=$msg?>
					</span>
				</div>
				<?php } ?>
				<h1><?=$acordmarc?></h1>
				<form id="msform" method="post" enctype="multipart/form-data">
					<!-- fieldsets -->
					<fieldset>
					<h2 class="fs-title">Selecció de lot</h2>

						<input style="width: 25%;" readonly="readonly" type="text" name="acordmarc" value="<?=$acordmarc?>" />
						<input style="width: 40%;" readonly="readonly" type="text" name="lot" value="<?=$lot?>" />

					<h2 class="fs-title">Indica les teves dades</h2>
						
						<input style="width: 33%;" required="required" pattern="\d{8,8}" type="text" name="code" value="<?=$code?>" placeholder="Codi centre Ex: 07000000"/>
						<input style="width: 66%;" required="required" type="text" name="school" value="<?=$school?>" placeholder="Nom centre"/>
						<input type="text" required="required" name="person" value="<?=$person?>" placeholder="Persona de contacte"/>
						<input type="text" required="required" name="phone" value="<?=$phone?>" placeholder="Telèfon de contacte"/>
						<input type="text" required="required" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="email" value="<?=$email?>" placeholder="Email"/>

						<h2 class="fs-title">Explica la proposta</h2>	
						
						<!-- FULL DE COMANDA-->
						<div style="display:flex;">
							<label style="width: 50%;"> Full de comanda (PDF):
								<a href="<?=$folderUrl?><?=$amyear?>/<?=$fullcomandaname?>" class="fa fa-download" download="<?=$fullcomandaname?>"></a>
							</label>
							<input style="width: 50%;" name="fullcomanda" required="required" type="file" accept=".pdf"/> 
						</div>

						<!-- MEMORIA JUSTIFICATIVA -->
						<div style="display:flex;">
							<label style="width: 50%;"> Memòria Justificativa (PDF): 
								<a href="<?=$folderUrl?><?=$amyear?>/informe-justificatiu.odt" class="fa fa-download" download="informe-justificatiu.odt"></a>
							</label>
							<input style="width: 50%;" name="memoriajustificativa" required="required" type="file" accept=".pdf"/> 
						</div>

						<!-- DISPONIBILITAT DE FONS -->
						<div style="display:flex;">
							<label style="width: 50%;"> Disponibilitat de fons (PDF): 
								<a href="<?=$folderUrl?><?=$amyear?>/certificat-fons.odt" class="fa fa-download" download="certificat_fons.odt"></a>
							</label>
							<input style="width: 50%;" name="disponibilitatfons" required="required" type="file" accept=".pdf"/> 
						</div>
						
						
						<!--div with hCapcha block-->
						<div style="padding-top:50px" class="h-captcha" data-sitekey="fa1ea092-589c-4498-9556-3a0ca1066d71"></div>

						<input type="submit" name="submit" class="submit action-button" value="Submit"/>
					</fieldset>
				</form>
			</div>
		</div>		
	</div>
</article>
</div>

<!--js doesnt function-->
<script>
	function catSelect()
	{
		var d = document.getElementById("select_id").value;
		//alert(d);
	}
</script>