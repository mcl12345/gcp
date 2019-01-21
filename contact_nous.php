<?php
include('connection_bdd.php');
include('logo_search_menu.php');
include('footer.php');

print_LOGO_FORMSEARCH_MENU();

//contact-nous
echo "
<div class='contact-nous'>
<div class='container '>
<div class='col-md-5'>
    <div class='form-area'>
        <form action='contact_nous_valide.php' method='POST'>
        <br style='clear:both'>
                    <h3 style='margin-bottom: 25px; text-align: center;'>Pour nous contacter</h3>
    				<div class='form-group'>
						<input type='text' class='form-control' id='name' name='name' placeholder='Nom' required>
					</div>
					<div class='form-group'>
						<input type='text' class='form-control' id='email' name='email' placeholder='Email' required>
					</div>
					<div class='form-group'>
						<input type='text' class='form-control' id='mobile' name='mobile' placeholder='N° de Téléphone' required>
					</div>
					<div class='form-group'>
						<input type='text' class='form-control' id='subject' name='subject' placeholder='Subject' required>
					</div>
                    <div class='form-group'>
                    <textarea class='form-control' type='text' id='message' name='message' placeholder='Message' maxlength='140' rows='7'></textarea>
                        <!--<span class='help-block'><p id='characterLeft' class='help-block '>Vous avez atteint la limite</p></span>-->
                    </div>

        <input type='submit' id='submit' name='submit' class='btn btn-primary pull-right' value='Envoyer'></input>
        </form>
    </div>
</div>
</div>
</div>";


echo footer();
echo '</body>
</html>';

?>
