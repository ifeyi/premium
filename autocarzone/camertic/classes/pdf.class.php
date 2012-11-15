<?php

/**
 * Classe de traitements et layoutions sur les fichier
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	MyFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */
//include_once('camertic/librairies/fpdf.php');
class pdf extends FPDF {

	public function __construct() {
		parent::__construct();
	}
	
	/*
	
	*/
	public function Header() {
		// Logo
		$this->Image('logo.png',10,6,30);
		// Police Arial gras 15
		$this->SetFont('Arial','B',15);
		// Décalage à droite
		$this->Cell(50);
		// Titre
		$this->Cell(100,10,'Pharmacie Provinciale',1,0,'C');
		// Saut de ligne
		$this->Ln(20);
	}

	// Pied de page
	public function Footer() {
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Arial','I',8);
		// Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	// Tableau simple
	public function BasicTable($header, $data) {
		// En-tête
		$this->Ln();
		foreach($header as $k => $col) {
			switch($k) {
				case '0': $this->Cell(12,7,$col,1); break;
				case '1': $this->Cell(20,7,$col,1); break;
				case '2': $this->Cell(70,7,$col,1); break;
				case '3': $this->Cell(25,7,$col,1); break;
				case '4': $this->Cell(20,7,$col,1); break;
				case '5': $this->Cell(20,7,$col,1); break;
				case '6': $this->Cell(20,7,$col,1); break;
				default : $this->Cell(30,7,$col,1);
			}
		}
		$this->Ln();
		// Données
		foreach($data as $row) {
			foreach($row as $k => $col) {
				//var_dump($row); die;
				switch($k) {
					case 'idvente': $this->Cell(12,7,$col,1); break;
					case 'cip': $this->Cell(20,7,$col,1); break;
					case 'designation': $this->Cell(70,7,tronque($col, 27),1); break;
					case 'qte': $this->Cell(25,7,$col,1); break;
					case 'heure': $this->Cell(20,7,$col,1); break;
					case 'datevente': $this->Cell(20,7,$col,1); break;
					case 'user': $this->Cell(20,7,tronque($col, 10),1); break;
					default : $this->Cell(30,7,$col,1);
				}
			}
			$this->Ln();
		}
	}

	// Tableau amélioré
	public function ImprovedTable($header, $data) {
		// Largeurs des colonnes
		$w = array(40, 35, 45, 40);
		// En-tête
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
		// Données
		foreach($data as $row) {
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R');
			$this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R');
			$this->Ln();
		}
		// Trait de terminaison
		$this->Cell(array_sum($w),0,'','T');
	}

	// Tableau coloré
	function FancyTable($header, $data) {
		// Couleurs, épaisseur du trait et police grasse
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// En-tête
		$w = array(40, 35, 45, 40);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Restauration des couleurs et de la police
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Données
		$fill = false;
		foreach($data as $row) {
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
			$this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R',$fill);
			$this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		// Trait de terminaison
		$this->Cell(array_sum($w),0,'','T');
	}
	
	public function __destructor() {
		
	}
	
}

?>