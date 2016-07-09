<?php

class partnerLinkDisp_sharedStatic
{
	public static function render_AdminCP_CustomLinksAdder(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit){
		$t = $preparedOption['option_value'];
		
		$choices = array();
		foreach($t as $entry){
			$choices[] = array(
				'url'    => is_string($entry['url'])    ? $entry['url']    : '',
				'imgurl' => is_string($entry['imgurl']) ? $entry['imgurl'] : '',
				'name'   => is_string($entry['name'])   ? $entry['name']   : '',
				'descr'  => is_string($entry['descr'])  ? $entry['descr']  : ''
			);
		}

		$editLink = $view->createTemplateObject('option_list_option_editlink', array(
			'preparedOption' => $preparedOption,
			'canEditOptionDefinition' => $canEdit
		));

		return $view->createTemplateObject('kiror_option_template_custom_partner_link', array(
			'fieldPrefix' => $fieldPrefix,
			'listedFieldName' => $fieldPrefix . '_listed[]',
			'preparedOption' => $preparedOption,
			'formatParams' => $preparedOption['formatParams'],
			'editLink' => $editLink,

			'choices' => $choices,
			'nextCounter' => count($choices)
		));
	}
	
	public static function verifier_AdminCP_CustomLinksAdder(array &$links, XenForo_DataWriter $dw, $fieldName){
		$output = array();

		foreach ($links AS $candidate){
			if (!isset($candidate['url'])       ||
				!isset($candidate['imgurl'])    ||
				!isset($candidate['name'])      ||
				!isset($candidate['descr'])     ||
				strlen($candidate['url'])<=0    ||
				strlen($candidate['imgurl'])<=0 ||
				strlen($candidate['name'])<=0   ||
				strlen($candidate['descr'])<=0){
				continue;
			}

			$tmp = array('url'   =>$candidate['url'] ,
						 'imgurl'=>$candidate['imgurl'],
						 'name'  =>$candidate['name'],
						 'descr' =>$candidate['descr']);
			if ($tmp && !in_array($tmp,$output)){
				$output[] = $tmp;
			}
		}

		$links = $output;

		return true;
	}
}
