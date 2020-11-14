<?php
/* Arrow Slideshow */
?>
<style>

    .<?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?>{
        width: 100%;
        height: 400px;
        position: relative;
    }

    .slideshow-fading .slideshow-slide-<?= $this->id ?>{
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        background-position: center center;
        background-size: cover;
    }

    .slideshow-fading .slideshow-dots-container{
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        text-align: center;
    }

    .slideshow-fading .slideshow-dots-container .slideshow-dot-<?= $this->id ?>{
        margin: 10px;
        width: 10px;
        height: 10px;
        border-radius: 20px;
        border: 1px solid #000;
        background-color: rgba(0,0,0,0);
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        opacity: 0.8;
    }

    .slideshow-fading .slideshow-dots-container .slideshow-dot-<?= $this->id ?>:hover{
        opacity: 1;
    }

    .slideshow-fading .slideshow-dots-container .slideshow-dot-active-<?= $this->id ?>{
        background-color: #000;
    }

</style>
<script>
    $(function () {

        var pluginClass = ".<?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?>";
        var slideNum = 1;
        var interval = parseInt("<? if ($this->animDuration == "") { ?><?= 5000 ?><? } else { ?><?= $this->animDuration ?><? } ?>");	/*Intervallo di scorrimento*/
        var animDuration = 300;
        var slideNumMax = parseInt("<?= ($galleriesContainer->getGalleryById($this->galleryId))?count($galleriesContainer->getGalleryById($this->galleryId)->getImagesArray()):'0' ?>");	/*Numero massimo delle slide, che sono le n che sono nella gallery*/
        var slideClass = ".slide-<?= $this->id ?>-";
        var slideClassGen = ".slideshow-slide-<?= $this->id ?>";
        var dotClassGen = ".slideshow-dot-<?= $this->id ?>";
        var dotClass = ".dot-<?= $this->id ?>-";
        var dotActiveClass = "slideshow-dot-active-<?= $this->id ?>";
        var lock = false;

        <?php
        if ($this->ratio && $this->ratio != "") {
            ?>
            var ratio = parseFloat("<?= $this->ratio ?>");
            <?php
        }
        ?>

        slideInterval = setInterval(fadeImages, interval);

        function fadeImages() {
            if (!lock) {
                lock = true;
                if (slideNum < slideNumMax) {
                    $(slideClass + (slideNum + 1)).fadeTo(animDuration, 1, function () {
                        $(dotClassGen).each(function () {
                            $(this).removeClass(dotActiveClass);
                        });
                        $(dotClass + (slideNum + 1)).addClass(dotActiveClass);
                        $(slideClass + slideNum).fadeTo(0, 0);
                        slideNum += 1;
                    });
                } else {
                    $(slideClass + (slideNum + 1)).fadeTo(animDuration, 1, function () {
                        $(dotClassGen).each(function () {
                            $(this).removeClass(dotActiveClass);
                        });
                        $(dotClass + "1").addClass(dotActiveClass);
                        $(slideClass + (slideNum + 1)).fadeTo(0, 0);
                        $(slideClass + slideNum).fadeTo(0, 0);
                        $(slideClass + 1).fadeTo(0, 1);
                        slideNum = 1;
                    });
                }
                lock = false;
            }
        }

        $(dotClassGen).click(function () {
            imgId = parseInt($(this).attr("img-id"));
            $(slideClassGen).each(function () {
                $(this).fadeTo(0, 0);
            });
            $(slideClass + imgId).fadeTo(0, 1, function () {
                $(dotClassGen).each(function () {
                    $(this).removeClass(dotActiveClass);
                });
                $(dotClass + imgId).addClass(dotActiveClass);
                $(slideClass + slideNum).fadeTo(0, 0);
                slideNum = imgId;
            });
        });

        $(pluginClass).hover(
                function () {
                    clearInterval(slideInterval);
                },
                function () {
                    slideInterval = setInterval(fadeImages, interval);
                }
        );

        <?php
        if ($this->ratio && $this->ratio != "") {
            ?>
            $(pluginClass).height($(pluginClass).width() * ratio);
            $(window).resize(function (event) {
                $(pluginClass).height($(pluginClass).width() * ratio);
            });
            <?php
        }
        ?>

    });
</script>
<div class="<?= $this->elementPlugin . "-" . $this->elementClass ?> <?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?> <?= $this->cssClass ?> slideshow-fading">
    <?php
    $galleryObject = $galleriesContainer->getGalleryById($this->galleryId);
    if ($galleryObject) { // Verifico esistenza gallery
        $gallery = $galleryObject->getImagesArray();
        $i;
        for ($i = 1; $i <= count($gallery); $i++) {
            ?>
            <div style="opacity:<?php if ($i == 1) { ?>1<?php } else { ?>0<?php } ?>;background-image:url('<?= $this->page->getHomeFolderRelativeHTMLURL() ?>img/<?= $gallery[$i - 1]->getPermalink() ?>/')" class="slideshow-slide-<?= $this->id ?> slide-<?= $this->id ?>-<?= $i ?>">
            </div>
            <?php
        }
        if (count($gallery) != 0) {
            ?>
            <div style="opacity:0;background-image: url('<?= $this->page->getHomeFolderRelativeHTMLURL() ?>img/<?= $gallery[0]->getPermalink() ?>/')" class="slideshow-slide-<?= $this->id ?> slide-<?= $this->id ?>-<?= $i ?>">
            </div>
            <?php
        }
        if (count($gallery) != 0) {
            ?>
            <div class="slideshow-dots-container">
                <div img-id="1" class="slideshow-dot slideshow-dot-<?= $this->id ?> slideshow-dot-active-<?= $this->id ?> dot-<?= $this->id ?>-1">
                </div>
                <?
                for ($i = 2; $i <= count($gallery); $i++) {
                    ?>
                    <div img-id="<?= $i ?>" class="slideshow-dot slideshow-dot-<?= $this->id ?> dot-<?= $this->id ?>-<?= $i ?>">
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
</div>