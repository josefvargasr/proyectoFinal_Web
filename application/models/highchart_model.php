<?php

class Highchart_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function crearHigChart($render,$title,$xaxis,$serie){
		$columnchart = new HighRollerColumnChart();
	    $columnchart->chart->renderTo = $render;
	    $columnchart->title->text = $title;
	    $columnchart->xAxis->categories = $xaxis;

	    $numSeries = count($serie);

	    for ($i=0; $i < $numSeries; $i++) { 
	    	$columnchart->addSeries($serie[$i]);
	    }
	    
	    return $columnchart;
	}

	public function crearSerie($name,$chartdata){
		$serie = new HighRollerSeriesData();
    	$serie->addName($name)->addData($chartdata);

    	return $serie;
	}

}