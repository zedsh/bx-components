<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require __DIR__ . "/config.php";

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage($config["lang_prefix"] . 'ELEMENTS_LIST_DESCRIPTION_NAME'),
	"DESCRIPTION" => Loc::getMessage($config["lang_prefix"] . 'DESCRIPTION_DESCRIPTION'),
	"ICON" => '/images/icon.gif',
	"SORT" => 20,
	"PATH" => array(
		"ID" => 'mscoder',
		"NAME" => Loc::getMessage($config["lang_prefix"] . 'DESCRIPTION_GROUP'),
		"SORT" => 10,
		"CHILD" => array(
			"ID" => 'standard',
			"NAME" => Loc::getMessage($config["lang_prefix"] . 'DESCRIPTION_DIR'),
			"SORT" => 10
		)
	),
);

?>
