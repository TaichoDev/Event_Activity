<?php 

	class BanniereModel {


		function showAllSlider(){
			$laRequete = "SELECT * FROM slider";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->requetesExec($laRequete,null);
		   	return $resultats;
		}


		function AllSlider(){
			$laRequete = "SELECT * FROM slider LEFT JOIN rel_slider_photo rsp ON rsp.idSlider = slider.idSlider LEFT JOIN photo p ON p.idPhoto = rsp.idPhoto ";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->requetesExec($laRequete,null);
		   	return $resultats;
		}

		function ifExist($data){
			$laRequete = "SELECT * FROM rel_slider_photo WHERE idSlider = ? ";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->requetesExec($laRequete,$data);
		   	return $resultats;
		}


		function saveSlider($data){

			$test = $this->ifExist([$data[2]]);
			if ($test[0]['idSlider']>0) {
				
				$laRequete = "UPDATE `rel_slider_photo` SET `idPhoto`= ? ,`linkevent`= ?  WHERE `idSlider`= ? ";
			}else{
				$laRequete = "INSERT INTO `rel_slider_photo`(`idPhoto`, `linkevent`, `idSlider` ) VALUES ( ? , ? , ? )";
			}

			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->updateDeleteExec($laRequete,$data);
		   	return $resultats;
		}

		function showOneSlider($data){
			$laRequete = "SELECT * FROM slider LEFT JOIN rel_slider_photo rsp ON rsp.idSlider = slider.idSlider LEFT JOIN photo p ON p.idPhoto = rsp.idPhoto WHERE slider.idSlider = ? ";
			$bdd = new Bdd(HOST,BASE,USER,PWD);
		   	$resultats = $bdd->requetesExec($laRequete,$data);
		   	return $resultats;
		}



	}