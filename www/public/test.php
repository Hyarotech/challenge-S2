<?php
require "../vendor/autoload.php";
function htmlToJson(): array
{
    libxml_use_internal_errors(true);
    ob_start();
    require "./test.html";
    $html = ob_get_clean();
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    libxml_clear_errors();
    libxml_use_internal_errors(false);
    $root = $dom->documentElement;
    return elementToJson($root);
}

function elementToJson($element): array
{
    $obj = array("type" => $element->tagName);
    if ($element->hasAttributes()) {
        $attributes = array();
        foreach ($element->attributes as $attr) {
            $attributes[$attr->name] = $attr->value;
        }
        $obj["attributes"] = $attributes;
    }
    if ($element->hasChildNodes()) {
        $children = array();
        foreach ($element->childNodes as $childNode) {
            if ($childNode instanceof DOMText) {
                if (trim($childNode->wholeText) !== "") {
                    $children[] = $childNode->wholeText;
                }
            } else if ($childNode instanceof DOMElement) {
                $children[] = elementToJson($childNode);
            }
        }
        if (count($children) > 0) {
            $obj["children"] = $children;
        }
    }
    return $obj;
}

dd(json_encode(htmlToJson()));

