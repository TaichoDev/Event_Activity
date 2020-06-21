<?php



	/**
	 *
	 */
	class PhotoEventControlleur
	{



		public function addImage($data){

			$element = new PhotoEventModel();
			$lastIdImage = $element->insPhoto($data);

			return $lastIdImage;
		}



		public function traitementImage($tabDonnees = [], $idPhoto = null){
			
			$idPhoto = ($idPhoto == null ) ? 0 : $idPhoto;	

			$laRequetePhoto="";
			$photo = [
						'urlPhoto' => "https://via.placeholder.com/350",
						'nomPhoto' => "https://placeholder.com"
					];
			// photo!
			if (!empty($tabDonnees['name'])) {


				if ($tabDonnees["error"]==0)
				{

					$info=pathinfo($tabDonnees["name"]);
					$location = $tabDonnees["name"];
					$extentions=strtolower($info["extension"]);
					$extentionsAutorises=array('png','jpeg','jpg');
					$maxSize=2097152;
					if ($_FILES['image']['size']>$maxSize) {
						echo "L'image est trop grosse";
					}
					else if (!in_array($extentions,$extentionsAutorises)) 
					{
						echo "extension non autorisé";
					}else{
						$chemin= 'www/img/photo';
						$tab["photo"]=$location ;
						$chemins=$chemin."/".$location ;

						if(!move_uploaded_file($_FILES['image']['tmp_name'],$chemins)){
							echo "Il y a eu une erreur dans le chargement.";
						}
					}
					
					$photo = array($location,$info['filename']);

				}else{
					$tab["photo"]= $idPhoto;
				}
			} else {
				$tab["photo"]=$idPhoto;
			}
			$tableau = [
				'tab' => $tab["photo"],
				'photo' => $photo
			];

			return $tableau;
		}

	}
