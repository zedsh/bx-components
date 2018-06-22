<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;

require __DIR__. "/config.php";

\CBitrixComponent::includeComponentClass('system:extend.elements.list');

\CBitrixComponent::includeComponentClass('system:standard.elements.list');

class ExtendElementListExampleComponent extends ExtendElementListComponent
{
    public function onPrepareComponentParams($params)
    {
        $result = parent::onPrepareComponentParams($params);
        //$result['NAME'] = trim(htmlspecialchars($_REQUEST['NAME'])); - пример добавления параметра в массив параметров компонента
        return $result;
    }

    /**
    *Отработает только без активного кэша один раз. Далее этот блок не будет работать - будет выдан HTML-кэш результата шаблона.
    **/
    protected function getResult()
    {
        $sort = array(
            $this->arParams['SORT_FIELD1'] => $this->arParams['SORT_DIRECTION1'],
            $this->arParams['SORT_FIELD2'] => $this->arParams['SORT_DIRECTION2']
        );
        $filter = array(
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y'
        );

        $select = array(
            'ID',
            'NAME',
            'DETAIL_PAGE_URL',
            'PREVIEW_PICTURE',
            'PREVIEW_TEXT',
            'PREVIEW_TEXT_TYPE',
            'DATE_ACTIVE_FROM'
        );
        $elements = \CIBlockElement::GetList($sort, $filter, false, $this->navParams, $select);
        while ($element = $elements->GetNext()) {
            $this->arResult['ITEMS'][] = array(
                'ID' => $element['ID'],
                'NAME' => $element['NAME'],
                'URL' => $element['DETAIL_PAGE_URL'],
                'DATE' => $element['DATE_ACTIVE_FROM'],
                'TEXT' => $element['PREVIEW_TEXT'],
                'IMG' => \CFile::GetPath($element['PREVIEW_PICTURE'])
            );
        }
        if ($this->arParams['SHOW_NAV'] == 'Y' && $this->arParams['COUNT'] > 0) {
            $this->arResult['NAV_STRING'] = $elements->GetPageNavString('');
        }
    }
}

?>
