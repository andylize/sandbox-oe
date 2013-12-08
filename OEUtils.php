<?php

class OEUtils
{
	public static function xml_encode($assoc_array)
	{
		// create xml document
		$xml_res = new SimpleXMLElement("<?xml version=\"1.0\"?><results></results>");
		OEUtils::array_to_xml($assoc_array, $xml_res);
		return $xml_res->asXML();		
	}

	private static function array_to_xml($assoc_array, $xml_res)
	{
		foreach ($assoc_array as $key => $value) {
			if (is_array($value)) {
				if (!is_numeric($key)) {
					$subnode = $xml_res->addChild("$key");
					OEUtils::array_to_xml($value, $subnode);
				}
				else {
					$subnode = $xml_res->addChild("item$key");
					OEUtils::array_to_xml($value, $subnode);
				}
			}
			else {
				$child = $xml_res->addChild("$key");
				$child->value = $value;
				//$xml_res->addChild("$key", "$value");
			}
		}
	}
}

?>