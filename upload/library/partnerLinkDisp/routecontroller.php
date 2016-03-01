<?php

class partnerLinkDisp_routecontroller extends XenForo_ControllerPublic_Abstract{
	public function actionIndex(){
		$xfopt = XenForo_Application::get('options');
		$viewParams = array();
		$viewParams['altTxt']=$xfopt->partnersitesnonetxt;
		$viewParams['sites']=$xfopt->partnersitesarray;
		$viewParams['emptySiteList']=(count($viewParams['sites'])<=0);
		return $this->responseView('XenForo_ViewPublic_Base', 'kiror_floating_partner_links', $viewParams);
	}
}
