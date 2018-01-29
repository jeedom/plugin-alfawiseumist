<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

/* * ***************************Includes**********************************/
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class alfawiseumist extends eqLogic {
	/***************************Attributs*******************************/	
	public function getImage(){
		return 'plugins/alfawiseumist/plugin_info/alfawiseumist_icon.png';
	}
	
	public function postSave() {
		$off = $this->getCmd(null, 'off');
		if (!is_object($off)) {
			$off = new alfawiseumistcmd();
			$off->setLogicalId('off');
			$off->setDisplay('icon','<i class="fa fa-times"></i>');
			$off->setIsVisible(1);
			$off->setName(__('Arrêter le brumisateur', __FILE__));
		}
		$off->setType('action');
		$off->setSubType('other');
		$off->setEqLogic_id($this->getId());
		$off->save();
		
		$on = $this->getCmd(null, 'on');
		if (!is_object($on)) {
			$on = new alfawiseumistcmd();
			$on->setLogicalId('on');
			$on->setDisplay('icon','<i class="fa fa-power-off"></i>');
			$on->setIsVisible(1);
			$on->setName(__('Allumer le brumisateur', __FILE__));
		}
		$on->setType('action');
		$on->setSubType('other');
		$on->setEqLogic_id($this->getId());
		$on->save();
		
		$speed0 = $this->getCmd(null, 'speed0');
		if (!is_object($speed0)) {
			$speed0 = new alfawiseumistcmd();
			$speed0->setLogicalId('speed0');
			$speed0->setDisplay('icon','<i class="fa fa-times-circle"></i>');
			$speed0->setIsVisible(1);
			$speed0->setName(__('Vitesse à 0', __FILE__));
		}
		$speed0->setType('action');
		$speed0->setSubType('other');
		$speed0->setEqLogic_id($this->getId());
		$speed0->save();
		
		$speed1 = $this->getCmd(null, 'speed1');
		if (!is_object($speed1)) {
			$speed1 = new alfawiseumistcmd();
			$speed1->setLogicalId('speed1');
			$speed1->setDisplay('icon','<i class="fa fa-minus-circle"></i>');
			$speed1->setIsVisible(1);
			$speed1->setName(__('Vitesse à 1', __FILE__));
		}
		$speed1->setType('action');
		$speed1->setSubType('other');
		$speed1->setEqLogic_id($this->getId());
		$speed1->save();
		
		$speed2 = $this->getCmd(null, 'speed2');
		if (!is_object($speed2)) {
			$speed2 = new alfawiseumistcmd();
			$speed2->setLogicalId('speed2');
			$speed2->setDisplay('icon','<i class="fa fa-plus-circle"></i>');
			$speed2->setIsVisible(1);
			$speed2->setName(__('Vitesse à 2', __FILE__));
		}
		$speed2->setType('action');
		$speed2->setSubType('other');
		$speed2->setEqLogic_id($this->getId());
		$speed2->save();
		
		$count1 = $this->getCmd(null, 'count1');
		if (!is_object($count1)) {
			$count1 = new alfawiseumistcmd();
			$count1->setLogicalId('count1');
			$count1->setIsVisible(1);
			$count1->setName(__('1h', __FILE__));
		}
		$count1->setType('action');
		$count1->setSubType('other');
		$count1->setEqLogic_id($this->getId());
		$count1->save();
		
		$count3 = $this->getCmd(null, 'count3');
		if (!is_object($count3)) {
			$count3 = new alfawiseumistcmd();
			$count3->setLogicalId('count3');
			$count3->setIsVisible(1);
			$count3->setName(__('3h', __FILE__));
		}
		$count3->setType('action');
		$count3->setSubType('other');
		$count3->setEqLogic_id($this->getId());
		$count3->save();
		
		$count6 = $this->getCmd(null, 'count6');
		if (!is_object($count6)) {
			$count6 = new alfawiseumistcmd();
			$count6->setLogicalId('count6');
			$count6->setIsVisible(1);
			$count6->setName(__('6h', __FILE__));
		}
		$count6->setType('action');
		$count6->setSubType('other');
		$count6->setEqLogic_id($this->getId());
		$count6->save();
		
		$gradient = $this->getCmd(null, 'gradient');
		if (!is_object($gradient)) {
			$gradient = new alfawiseumistcmd();
			$gradient->setLogicalId('gradient');
			$gradient->setIsVisible(1);
			$gradient->setDisplay('icon','<i class="fa fa-random"></i>');
			$gradient->setName(__('Mode gradient', __FILE__));
		}
		$gradient->setType('action');
		$gradient->setSubType('other');
		$gradient->setEqLogic_id($this->getId());
		$gradient->save();
		
		$quiet = $this->getCmd(null, 'quiet');
		if (!is_object($quiet)) {
			$quiet = new alfawiseumistcmd();
			$quiet->setLogicalId('quiet');
			$quiet->setDisplay('icon','<i class="fa fa-asterisk"></i>');
			$quiet->setIsVisible(1);
			$quiet->setName(__('Mode quiet', __FILE__));
		}
		$quiet->setType('action');
		$quiet->setSubType('other');
		$quiet->setEqLogic_id($this->getId());
		$quiet->save();
		
		$flash = $this->getCmd(null, 'flash');
		if (!is_object($flash)) {
			$flash = new alfawiseumistcmd();
			$flash->setLogicalId('flash');
			$flash->setDisplay('icon','<i class="fa fa-bolt"></i>');
			$flash->setIsVisible(1);
			$flash->setName(__('Mode flash', __FILE__));
		}
		$flash->setType('action');
		$flash->setSubType('other');
		$flash->setEqLogic_id($this->getId());
		$flash->save();
		
		$color = $this->getCmd(null, 'color');
		if (!is_object($color)) {
			$color = new alfawiseumistcmd();
			$color->setLogicalId('color');
			$color->setIsVisible(1);
			$color->setName(__('Couleur', __FILE__));
		}
		$color->setType('action');
		$color->setSubType('color');
		$color->setEqLogic_id($this->getId());
		$color->save();
	}
}

class alfawiseumistCmd extends cmd {
	/***************************Attributs*******************************/


	/*************************Methode static****************************/

	/***********************Methode d'instance**************************/

	public function execute($_options = null) {
		if ($this->getType() == '') {
			return '';
		}
		$eqLogic = $this->getEqlogic();
		$devid = $eqLogic->getConfiguration('devid','0');
		$action = $this->getLogicalId();
		$cmd = system::getCmdSudo() . '/usr/bin/python ' .dirname(__FILE__) . '/../../resources/alfawiseumist.py --deviceid ' . $devid . ' --action ' . $action;
		if ($action == 'color'){
			$color = strtolower(str_replace('#','',$_options['color']));
			$cmd .= ' --options ' . $color;
		}
		log::add('alfawiseumist','debug','Execution de la commande suivante : ' .$cmd);
		$result=shell_exec($cmd);
	}

	/************************Getteur Setteur****************************/
}
?>