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
require_once( ABSPATH . '/wp-includes/PHPMailer/Exception.php');
require_once( ABSPATH . '/wp-includes/PHPMailer/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;

// Global data
$success = true;
$msg = "";
$code = "";
$school = "";
$person = "";
$phone = "";
$email = "";
$description = "";
$allowFileTypes = array('pdf', 'jpg', 'png', 'jpeg'); 

//chech chaptcha when user submit form
if(isset($_POST['submit'])) {
	
	$code = $_POST['code'];
	$school = $_POST['school'];
	$person = $_POST['person'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$description = $_POST['description'];
	$subject = "[EDUCACIO] ".$school." Consultes i propostes";
	$file = null;
	
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
		// Form conection
		if(isset($_POST)){
			if(!empty($_FILES["attachment"]["name"])){
				$fileType = pathinfo($_FILES["attachment"]["name"], PATHINFO_EXTENSION); 
				
				// Check allowed type files
				if( !in_array($fileType, $allowFileTypes) ){ 
					$success = false;
					$msg = "El tipus d'arxiu no és correcte";
				}
			}
			
			if ($success) {
				//Send email to RT
				$mail = new PHPMailer();
				$mail->CharSet = "UTF-8";
				$mail->isSendmail();
				$mail->setFrom($email, $person);
				$mail->addAddress(EMAIL_CAU_EDUCACIO, 'CAU Educació');

				$mail->Subject = $subject;
				$mail->isHTML(true);
				$mail->Body = '<h2>Formulari</h2> 
					<p><b>- Formulari:</b>[EDUCACIO]</p> 
					<p><b>- Codi del centre:</b> '.$code.'</p> 
					<p><b>- Nom coordinador:</b> '.$person.'</p> 
					<p><b>- Telèfon centre:</b>'.$phone.'</p> 
					<p><b>- Descripció:</b>'.$description.'</p>';

				if(!empty($_FILES["attachment"]["name"])){
					$mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
				}

				// Send email
				if (ENVIRONMENT != 'local') {				
					$result = $mail->send();
					if ($result){
						$success = true;
						$msg = "Email enviat correctament";
					} else {
						$success = false;
						$msg = "Error en l'enviament del mail." . $mail->ErrorInfo;
					}
				} else {
					$msg = "Entorn de prova. Missatge correcte";
				}
			}

		} else {
			$success = false;
			$msg = "Error inesperat. Torna a intentar-ho.";
		}
	}else{
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
				<form id="msform" method="post" enctype="multipart/form-data">
					<!-- fieldsets -->
					<fieldset>
						<h2 class="fs-title">Indica les teves dades</h2>
						
						<input style="width: 33%;" required="required" pattern="\d{8,8}" type="text" name="code" value="<?=$code?>" placeholder="Codi centre Ex: 07000000"/>
						<input style="width: 66%;" required="required" type="text" name="school" value="<?=$school?>" placeholder="Nom centre"/>
						<input type="text" required="required" name="person" value="<?=$person?>" placeholder="Persona de contacte"/>
						<input type="text" required="required" name="phone" value="<?=$phone?>" placeholder="Telèfon de contacte"/>
						<input type="text" required="required" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="email" value="<?=$email?>" placeholder="Email"/>

						<h2 class="fs-title">Explica la proposta</h2>	
						<textarea required="required" name="description" value="<?=$description?>" placeholder="Descripció"><?=$description?></textarea>

						<!-- Name of input element determines name in $_FILES array -->
						<label for="inputTag"> Adjunta un arxiu (Max:100MB. Formats: pdf, jpg, png, jpeg): 
							<input name="attachment" type="file" accept=".pdf, .jpg, .png, .jpeg"/> 
						</label>
						
						<!--div with hCapcha block-->
						<div class="h-captcha" data-sitekey="fa1ea092-589c-4498-9556-3a0ca1066d71"></div>

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