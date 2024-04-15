<?php
class LinkController {
    private $linkModel;

    public function __construct($linkModel) {
        $this->linkModel = $linkModel;
    }


    public function createShortLink($url) {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $shortCode = $this->linkModel->createShortLink($url);
        return $shortCode ? $shortCode : false;
    }
}
?>
