			</main>
			<footer>
				<section class="info">
					<article>

						Copyright 2019
						<a href="index.php" >Event Activity</a>
					</article>
				</section>
				

				<section>
					<span>Réaliser par TaichoDev</span>
				</section>
			</footer>
	</body>
	<div id="myModal" class="modal">
	
		<!-- Modal content -->
		<div class="modal-content">
			<span class="close">&times;</span>
			<section  id="myInsciption">
				<h3>S'inscrire</h3>
				<form  id="dataRegister">
					<p class="champs">
						<span>
							<label>Civilité</label>
							<select name="Civilite">
								<option value="1">Mr</option>
								<option value="2">Mme</option>
							</select>
						</span>
						<span>
							<label for="nomUser">Nom *</label>
							<input id="nomUser" type="text" name="nomUser" required pattern="^[A-Za-z '-]+$" maxlength="50" value="">
						</span>
						<span>
							<label for="prenomUser">Prénom *</label>
							<input type="text" id="prenomUser" name="prenomUser" required pattern="^[A-Za-z '-]+$" maxlength="50" value="">
						</span>
						<span>
							<label for="dttnUser">Date de Naissance</label>
							<input type="date" name="dtnUser" value="">
						</span>
						<span>
							<label for="adresseUser">Adresse *</label>
							<input type="text" id="adresseUser" name="adresseUser" required pattern="^[A-Za-z '-]+$" maxlength="50" value="">
						</span>
						<span>
							<label for="adresseBisUser">Complément adresse</label>
							<input type="text" id="adresseBisUser" name="adresseBisUser" required pattern="^[A-Za-z '-]+$" maxlength="50" value=" ">
						</span>
						<span>
							<label for="cp">CP *</label>
							<input id="cp" type="text" name="cpUser" required pattern="^[0-9]+$" maxlength="5" value="">
						</span>
						<span>
							<label for="ville">Ville *</label>
							<input type="text" id="ville" name="villeUser" required pattern="^[A-Za-z '-]+$" maxlength="50" value="">
						</span>
						<span>
							<label for="paysUser">Pays *</label>
							<input type="text" id="paysUser" name="paysUser" required pattern="^[A-Za-z '-]+$" maxlength="50" value="">
						</span>
						<span>
							<label for="mail">Email *</label>
							<input id="mail" type="email" name="mailUser" required 
						pattern="([A-Za-z0-9][._]?)+[A-Za-z0-9]@[A-Za-z0-9]+(\.?[A-Za-z0-9]){2}\.(\.[A-Za-z0-9]{2,4})?" maxlength="50" value="">
						</span>
						<span>
							<label for="mdp">Mot de passe *</label>
							<input id="mdp" type="password" name="mdpUser" required value="">
						</span>
						<span>
							<label>Confirmer mot de passe *</label>
							<input type="password" name="confirMdpUser" required value="">
						</span>
					</p>
					<p class='action'>	
						<button class="cancellog" type="button">Annuler <i class="fas fa-times"></i></button>
						<button id="valinscription" type="button">S'inscrire <i class="fas fa-sign-out-alt"></i></button>
					</p>
				</form>
			</section>			
		
			<section id="myLogin">
				<h3>Se Connecter</h3>
				<form id="datalogin">					
					<p class="champs ">					
						<label>Email</label><input type="text" name="mailUser">
						<label>Mot de passe</label><input type="password" name="mdpUser">
					</p>
					<p class='action'>
						<button class="cancellog" type="button">Annuler <i class="fas fa-times"></i></button>
						<button id="validerlogin" type="button">Se connecter <i class="fas fa-sign-in-alt"></i></button>
					</p>
				</form>
			</section>
		
			<section id="inOrOut">
				<h3>Se Connecter</h3>
				<form >
					
					<p class="champs ">
					
						<button class="in" id="login" type="button">Se connecter</button>
						<button class="out" id="register" type="button">S'inscrire</button>
					</p>
					<p class='action'>
						<button class="cancellog" type="button">Annuler <i class="fas fa-times"></i></button>							
					</p>
				</form>
			</section>		
			<section id="myInformation">
				<h3>Information</h3>
				<p>
					<label id="message"></label>
				</p>				
				<p class='action'>					
					<button class="cancellog" type="button">OK <i class="fas fa-times"></i></button>					
				</p>
			</section>
			<section id="myRegister">
				<h3>Information</h3>
				<p>
					<label id="info"></label>
				</p>				
				<p class='action'>					
					<button class="cancellog" type="button">OK <i class="fas fa-times"></i></button>
					<button class="out" type="button">S'inscrire <i class="fas fa-times"></i></button>	
				</p>
			</section>
			<section id="accueil">
				<h3>Information</h3>
				<p>
					<label id="msg"></label>
				</p>				
				<p class='action'>					
					<button class="accueil" type="button">OK <i class="fas fa-times"></i></button>					
				</p>
			</section>
			<section id="myLogOut">
				<h3>Se deconnecter</h3>
				<p>
					<label>Vous voulez vraiment vous déconnecter ?</label>
				</p>
				<p class='action'>
					<button class="cancellog" type="button">Annuler <i class="fas fa-times"></i></button>
					<button id="validerlogout" type="button">Se deconnecter <i class="fas fa-check"></i></button>
					
				</p>
			</section>
		</div>
		

	</div>
	<script type="text/javascript" src="www/js/base.js"></script>
	<script type="text/javascript" src="www/js/functionFront.js"></script>
</html>
