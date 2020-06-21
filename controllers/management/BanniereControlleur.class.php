<?php 

	class BanniereControlleur {


		function displayListeOfSlider(){
			$Sliders = new BanniereModel();
			$resSlider  = $Sliders->showAllSlider();

			$tableau = [
				'resSlider' => $resSlider
			];
			$maVue = new View($tableau,"lessliders","Administration");
            $maVue->getViewBack();			
		}


		function showOneSlider(){
			$data = [$_GET['PARA']];
			$Sliders = new BanniereModel();
			$resleSlider  = $Sliders->showOneSlider($data);
			
			$tableau = [
				'reslesEvent' => $reslesEvent
			];
		
		  	$tableau['urlPhoto']  = (isset($resleSlider[0]["urlPhoto"])) ? 'www/img/photo/'.$resleSlider[0]["urlPhoto"] :  'http://loremflickr.com/320/240/dog';
		    $tableau['nomphoto']  = (isset($resleSlider[0]["nomPhoto"])) ? $resleSlider[0]["nomPhoto"] :  '';
		    $tableau['nomslider'] = (isset($resleSlider[0]["nomSlider"])) ? $resleSlider[0]["nomSlider"] :  '';
		    $tableau['idSlider']  = (isset($resleSlider[0][0])) ? $resleSlider[0][0] :  '';
		    $tableau['linkevent'] = (isset($resleSlider[0]['linkevent'])) ? $resleSlider[0]['linkevent'] :  '';
		    $tableau['idPhoto']   = (isset($resleSlider[0]["idPhoto"])) ? $resleSlider[0]["idPhoto"] :  '';	

			$maVue = new View($tableau,"leslide","Administration");
            $maVue->getViewBack();
		}



		function saveSlider(){
			
			$idEvent = $_POST['slideevent'];
			$idSlider = $_POST['idSlider'];
			if(tabIsEmpty($_FILES)){
				$retourTraitementImage = traitementPhoto($_FILES);
			}else{

				$idPhoto = $_POST['idPhoto'];
			}
			
			if (!isset($retourTraitementImage["erreur"]) || $idEvent > 0) {
				# code...
				if (!isset($retourTraitementImage["erreur"]) && empty($idPhoto))  {
					# code...
					$donnees = [$retourTraitementImage["basename"],$retourTraitementImage['filename']];
					$slider = new PhotoModel();
					$idPhoto = $slider->insPhoto($donnees);

				}

				$savedata = new BanniereModel();
				$data = [$idPhoto,$idEvent,$idSlider];				
				$retour = $savedata->saveSlider($data);				
	            $message = "Le slider a bien été modifié";
	            

			}else{
				$message = 'Pas de changement';
			}
            echo $message;
		}


	}