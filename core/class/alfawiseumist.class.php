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

	/*     * ***********************Methode static*************************** */
    public static function cron() {
		$eqLogics = eqLogic::byType('alfawiseumist', true);
        foreach ($eqLogics as $eqLogic) {
            log::add('alfawiseumist', 'debug', 'Rafraîchissement de alfawise : ' . $eqLogic->getName());
            $refreshcmd = alfawiseumistcmd::byEqLogicIdAndLogicalId($eqLogic->getId(),'read');
            $refreshcmd->execCmd();
        }
	}
    
	
	public function postSave() {
		// Infos
		$state = $this->getCmd(null, 'state');
		if (!is_object($state)) {
				$state = new alfawiseumistcmd();
				$state->setLogicalId('state');
				$state->setDisplay('generic_type', 'ENERGY_STATE');
				$state->setIsVisible(1);
				$state->setName(__('Actif', __FILE__));
		}
		$state->setType('info');
		$state->setSubType('binary');
		$state->setEqLogic_id($this->getId());
		$state->save();

		$rgb = $this->getCmd(null, 'rgb');
		if (!is_object($rgb)) {
				$rgb = new alfawiseumistcmd();
				$rgb->setLogicalId('rgb');
				$rgb->setIsVisible(0);
				$rgb->setName(__('Couleur', __FILE__));
		}
		$rgb->setType('info');
		$rgb->setSubType('string');
		$rgb->setEqLogic_id($this->getId());
		$rgb->save();

		$countdown = $this->getCmd(null, 'countdown');
		if (!is_object($countdown)) {
				$countdown = new alfawiseumistcmd();
				$countdown->setLogicalId('countdown');
				$countdown->setIsVisible(0);
				$countdown->setName(__('Compte à rebours', __FILE__));
		}
		$countdown->setType('info');
        $countdown->setSubType('numeric');
		$countdown->setUnite('s');
		$countdown->setEqLogic_id($this->getId());
		$countdown->save();

		$speedMode = $this->getCmd(null, 'speed-mode');
		if (!is_object($speedMode)) {
				$speedMode = new alfawiseumistcmd();
				$speedMode->setLogicalId('speed-mode');
				$speedMode->setIsVisible(0);
				$speedMode->setName(__('Vitesse Mode', __FILE__));
		}
		$speedMode->setType('info');
		$speedMode->setSubType('numeric');
		$speedMode->setEqLogic_id($this->getId());
		$speedMode->save();

		$lightMode = $this->getCmd(null, 'light-mode');
		if (!is_object($lightMode)) {
				$lightMode = new alfawiseumistcmd();
				$lightMode->setLogicalId('light-mode');
				$lightMode->setDisplay('generic_type', 'LIGHT_MODE');
				$lightMode->setIsVisible(0);
				$lightMode->setName(__('Lumiere Mode', __FILE__));
		}
		$lightMode->setType('info');
		$lightMode->setSubType('numeric');
		$lightMode->setEqLogic_id($this->getId());
		$lightMode->save();


		$countdownFormated = $this->getCmd(null, 'countdown-formated');
		if (!is_object($countdownFormated)) {
				$countdownFormated = new alfawiseumistcmd();
				$countdownFormated->setLogicalId('countdown-formated');
				$countdownFormated->setIsVisible(1);
				$countdownFormated->setName(__('Temps Restant', __FILE__));
		}
		$countdownFormated->setType('info');
		$countdownFormated->setSubType('string');
		$countdownFormated->setEqLogic_id($this->getId());
		$countdownFormated->save();



		// Actions
		$read = $this->getCmd(null, 'read');
		if (!is_object($read)) {
			$read = new alfawiseumistcmd();
			$read->setLogicalId('read');
			$read->setDisplay('icon','<i class="fa fa-refresh"></i>');
                        $read->setIsVisible(1);
			$read->setName(__('Rafraichir', __FILE__));
		}
		$read->setType('action');
		$read->setSubType('other');
		$read->setEqLogic_id($this->getId());
		$read->save();

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

		$speedSet = $this->getCmd(null, 'speed-set');
		if (!is_object($speedSet)) {
			$speedSet = new alfawiseumistcmd();
			$speedSet->setLogicalId('speed-set');
			$speedSet->setIsVisible(1);
			$speedSet->setName(__('Vitesse', __FILE__));
		}
		$speedSet->setType('action');
		$speedSet->setSubType('slider');
		$speedSet->setConfiguration('minValue', 0);
		$speedSet->setConfiguration('maxValue', 2);
		$speedSet->setValue($speedMode->getId());
		$speedSet->setEqLogic_id($this->getId());
		$speedSet->save();

		$lightModeSet = $this->getCmd(null, 'light-set');
		if (!is_object($lightModeSet)) {
			$lightModeSet = new alfawiseumistcmd();
			$lightModeSet->setLogicalId('light-set');
			$lightModeSet->setIsVisible(1);
			$lightModeSet->setName(__('Lumiere Style', __FILE__));
		}
		$lightModeSet->setType('action');
		$lightModeSet->setSubType('select');
		$lightModeSet->setConfiguration('listValue', '1|quiet;2|gradient;3|flash');
		$lightModeSet->setValue($lightMode->getId());
		$lightModeSet->setEqLogic_id($this->getId());
		$lightModeSet->save();

		$colorSet = $this->getCmd(null, 'color-set');
		if (!is_object($colorSet)) {
			$colorSet = new alfawiseumistcmd();
			$colorSet->setLogicalId('color-set');
			$colorSet->setIsVisible(1);
			$colorSet->setName(__('Définir Couleur', __FILE__));
		}
		$colorSet->setType('action');
		$colorSet->setSubType('color');
		$colorSet->setEqLogic_id($this->getId());
		$colorSet->setValue($rgb->getId());
		$colorSet->save();
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
		$devip = $eqLogic->getConfiguration('devip','255.255.255.255');
		$action = $this->getLogicalId();

		switch($action) {
			case 'speed-set':
				$action = 'speed'.$_options['slider'];
				break;
			case 'light-set':
				$action = 'light'.$_options['select'];
				break;
			case 'color-set':
				$action = 'color';
				break;
		}

		$cmd = system::getCmdSudo() . '/usr/bin/python ' .dirname(__FILE__) . '/../../resources/alfawiseumist.py --deviceid ' . $devid . ' --deviceip ' . $devip .  ' --action ' . $action;
		if ($action == 'color'){
			$color = strtolower(str_replace('#','',$_options['color']));
			$cmd .= ' --options ' . $color;
		}
		log::add('alfawiseumist','debug','Execution de la commande suivante : ' .$cmd);
		$result = shell_exec($cmd);
		log::add('alfawiseumist','debug','Resultat de la commande : ' .$result);
		if ($result !== null) {
			$infos = @json_decode($result, true);
			if (isset($infos['sa_ctrl'])) { $eqLogic->checkAndUpdateCmd('state', $infos['sa_ctrl']); }
			if (isset($infos['l_color'])) { $eqLogic->checkAndUpdateCmd('rgb', '#'.$infos['l_color']); }
			if (isset($infos['countdown'])) {
				$seconds = hexdec($infos['countdown']);
				$eqLogic->checkAndUpdateCmd('countdown', $seconds);
				$eqLogic->checkAndUpdateCmd('countdown-formated', gmdate("H:i:s", $seconds));
			}
			if (isset($infos['h_rank'])) { $eqLogic->checkAndUpdateCmd('speed-mode', $infos['h_rank']); }
			if (isset($infos['l_mode'])) { $eqLogic->checkAndUpdateCmd('light-mode', $infos['l_mode']); }
		}
	}

	/************************Getteur Setteur****************************/
}
?>
