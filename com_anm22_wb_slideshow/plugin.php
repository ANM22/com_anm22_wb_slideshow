<?php

/**
 * Slideshow plugins for ANM22 WebBase CMS.
 *
 * @author Andrea Menghi <andrea.menghi@anm22.it>
 */

/**
 * Slideshow plugin basic
 */
class com_anm22_wb_editor_slideshow extends com_anm22_wb_editor_page_element
{

    var $elementClass = "com_anm22_wb_editor_slideshow";
    var $elementPlugin = "com_anm22_wb_slideshow";
    var $elementClassName = "Slideshow";
    var $elementClassIcon = "images/Icone/gallery.png";
    var $imageNumber;
    var $milliseconds;
    var $cssClass;

    /**
     * @deprecated since editor 3.0
     * 
     * Method to init the element.
     * 
     * @param SimpleXMLElement $xml Element data
     * @return void
     */
    function importXMLdoJob($xml)
    {
        $this->imageNumber = intval($xml->imageNumber);
        $this->milliseconds = intval($xml->milliseconds);
        $this->cssClass = $xml->cssClass;
    }

    /**
     * Method to init the element.
     * 
     * @param mixed[] $data Element data
     * @return void
     */
    public function initData($data)
    {
        $this->imageNumber = intval($data['imageNumber']);
        $this->milliseconds = intval($data['milliseconds']);
        $this->cssClass = htmlspecialchars_decode($data['cssClass']);
    }

    /**
     * Render the page element
     * 
     * @return void
     */
    function show()
    {
        $src = $this->page->getHomeFolderRelativePHPURL() . "ANM22WebBase/upload/" . $this->page->getPageLanguage() . "_" . $this->page->getPageLink() . "_" . $this->id;
        ?>
        <link href="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/css/slideshow.css" type="text/css" rel="stylesheet" />
        <?
        if ($this->imageNumber > 1) {
            ?>
            <script type="text/javascript">
                var com_anm22_wb_editor_slideshow_id_<?= $this->id ?>_loopN = <?= $this->imageNumber ?>;
                var com_anm22_wb_editor_slideshow_id_<?= $this->id ?>_offset = <?= $this->imageNumber ?>;
                var com_anm22_wb_editor_slideshow_id_<?= $this->id ?>_imgNumber = <?= $this->imageNumber ?>;
                var com_anm22_wb_editor_slideshow_id_<?= $this->id ?>_milliseconds = <?= $this->milliseconds ?>;

                window.onload = function () {
                    com_anm22_wb_editor_slideshow_loop('<?= $this->id ?>')
                }
            </script>
            <script type="text/javascript" src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/js/slideshow.js"></script>
            <?
        }
        ?>
        <div class="<?= $this->elementPlugin ?>_<?= $this->elementClass ?> <?= $this->cssClass ?>">
            <div id="slideshow_id_<?= $this->id ?>_s1" class="slideshow_sp_s1" style="background-image:url(<?= $src ?>-1.png);"></div>
            <?
            if ($this->imageNumber > 1) {
                ?>
                <div id="slideshow_id_<?= $this->id ?>_s2" class="slideshow_sp_s2" style="background-image:url(<?= $src ?>-2.png);"></div>
                <?
            }
            if ($this->imageNumber > 1) {
                ?>
                <div id="slideshow_id_<?= $this->id ?>_s3" class="slideshow_sp_s3" style="background-image:url(<?= $src ?>-3.png);"></div>
                <?
            }
            ?>
            <div class="slideshow_button_conteiner">
                <img src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/img/btng.png" id="slideshow_id_<?= $this->id ?>_b1" class="slideshow_sp_off" />
                <img src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/img/btnn.png" id="slideshow_id_<?= $this->id ?>_b1_selected" />
                <?
                if ($this->imageNumber > 1) {
                    ?>
                    <img src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/img/btng.png" id="slideshow_id_<?= $this->id ?>_b2" class="slideshow_sp_off" />
                    <img src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/img/btnn.png" id="slideshow_id_<?= $this->id ?>_b2_selected" <? if ($this->imageNumber > 2) { ?>style="display:none;"<? } ?> />
                    <?
                }
                if ($this->imageNumber > 2) {
                    ?>
                    <img src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/img/btng.png" id="slideshow_id_<?= $this->id ?>_b3" class="slideshow_sp_off" />
                    <img src="<?= $this->page->getHomeFolderRelativePHPURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/img/btnn.png" id="slideshow_id_<?= $this->id ?>_b3_selected" />
                    <?
                }
                ?>
            </div>
        </div>
        <?
    }

}

/**
 * Slideshow plugin connected to the WebBase gallery engine
 */
class com_anm22_wb_editor_slideshowV2 extends com_anm22_wb_editor_page_element
{

    var $elementClass = "com_anm22_wb_editor_slideshowV2";
    var $elementPlugin = "com_anm22_wb_slideshow";
    var $elementClassName = "Slideshow";
    var $elementClassIcon = "images/plugin_icons/com_slideshow.png";
    private $galleryId;
    private $animDuration;
    private $slideshowType;
    private $paddingDesktop;
    private $paddingMobile;
    private $widthDesktop;
    private $widthMobile;
    private $ratio;
    private $ratioMini;
    private $ratioBig;
    private $cssClass;

    /**
     * @deprecated since editor 3.0
     * 
     * Method to init the element.
     * 
     * @param SimpleXMLElement $xml Element data
     * @return void
     */
    function importXMLdoJob($xml) {
        $this->galleryId = intval($xml->galleryId);
        $this->animDuration = intval($xml->animDuration);
        $this->slideshowType = $xml->slideshowType;
        $this->paddingDesktop = intval($xml->paddingDesktop);
        $this->paddingMobile = intval($xml->paddingMobile);
        $this->widthDesktop = intval($xml->widthDesktop);
        $this->widthMobile = intval($xml->widthMobile);
        $this->ratio = floatval($xml->ratio);
        $this->ratioMini = floatval($xml->ratioMini);
        $this->ratioBig = floatval($xml->ratioBig);
        $this->cssClass = $xml->cssClass;
    }

    /**
     * Method to init the element.
     * 
     * @param mixed[] $data Element data
     * @return void
     */
    public function initData($data)
    {
        $this->galleryId = intval($data['galleryId']);
        $this->animDuration = intval($data['animDuration']);
        $this->slideshowType = $data['slideshowType'];
        $this->paddingDesktop = intval($data['paddingDesktop']);
        $this->paddingMobile = intval($data['paddingMobile']);
        $this->widthDesktop = intval($data['widthDesktop']);
        $this->widthMobile = intval($data['widthMobile']);
        $this->ratio = floatval($data['ratio']);
        $this->ratioMini = floatval($data['ratioMini']);
        $this->ratioBig = floatval($data['ratioBig']);
        if (isset($data['cssClass']) && !is_array($data['cssClass'])) {
            $this->cssClass = htmlspecialchars_decode($data['cssClass'] ?? '');
        }
    }

    /**
     * Render the page element
     * 
     * @return void
     */
    function show()
    {
        /* Ricerca id news tramite parametro get se non precedentemente indicati */
        if ($this->galleryId == 0) {
            if (intval($this->page->getVariables['gId']) > 0) {
                $this->galleryId = intval($this->page->getVariables['gId']);
            }
        }
        ?><!-- GalleryId = <?= $this->galleryId?> --><?
        if ($this->galleryId > 0) {
            include_once "../ANM22WebBase/website/plugins/com_anm22_wb_gallery/gallery_functions.php";
            /* Reading the JSon file */
            $jsonFile = NULL;
            $jsonFile = file_get_contents($this->page->getHomeFolderRelativePHPURL() . "gallery/gallery.json");
            /* Decoding the file to an associative array */
            $jsonArray = json_decode($jsonFile, true);
            $galleriesContainer = new anm22_wb_galleries();
            /* Elaborating array into objects */
            if (is_array($jsonArray)) {
                /* Creates the galleries container */
                foreach ($jsonArray as $gallery) {
                    /* Objects */
                    $galleryObject = new anm22_wb_gallery($gallery["title"], $gallery["category"], $gallery["publicBool"], $gallery["creationDate"]);
                    foreach ($gallery["images"] as $image) {
                        $imageObject = new anm22_wb_img($image["name"], $image["extension"], $image["title"], $image["creationDate"], $image["description"]);
                        $galleryObject->addImage($imageObject);
                    }
                    $galleriesContainer->addGallery($galleryObject);
                }
            }
            switch ($this->slideshowType) {
                case "arrow":
                    include __DIR__ . "/slideshows/arrow_slideshow.php";
                    break;
                case "fading":
                    include __DIR__ . "/slideshows/fading_slideshow.php";
                    break;
                case "big":
                    include __DIR__ . "/slideshows/big_image_slideshow.php";
                    break;
                default:
                    include __DIR__ . "/slideshows/fading_slideshow.php";
                    break;
            }
        }
    }

}