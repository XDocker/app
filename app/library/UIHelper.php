<?php

/**
 * Class and Function List:
 * Function list:
 * - getDeploymentStatus()
 * Classes list:
 * - UIHelper
 */
class UIHelper
{
	public static function getLabel($status)
	{
		
		/*
		 * Default	<span class="label">Default</span>
Success	<span class="label label-success">Success</span>
Warning	<span class="label label-warning">Warning</span>
Important	<span class="label label-important">Important</span>
Info	<span class="label label-info">Info</span>
Inverse	<span class="label label-inverse">Inverse</span>
		 */
		switch($status)
		{
			case 'Completed' : return '<span class="label label-success">'.$status.'</span>'; break;
			case 'In Progress' : return '<span class="label">'.$status.'</span>'; break;
			case 'Started' : 
			case 'start' :return '<span class="label label-info">'.$status.'</span>'; break;
			case 'Stop' : return '<span class="label label-inverse">'.$status.'</span>'; break;
			case 'failed' : return '<span class="label label-important">'.$status.'</span>'; break;
		}
	}
	
}
