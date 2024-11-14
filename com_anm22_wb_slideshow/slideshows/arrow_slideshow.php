<?php
/*Arrow Slideshow*/
include_once $this->page->getHomeFolderRelativePHPURL() . "ANM22WebBase/website/plugins/com_anm22_wb_slideshow/js/perfect_scrollbar.php";
/*Include CSS della scrollbar*/
include_once $this->page->getHomeFolderRelativePHPURL() . "ANM22WebBase/website/plugins/com_anm22_wb_slideshow/css/perfect_scrollbar.php";
/*Include CSS della slideshow*/
?>
<link href="<?= $this->page->getHomeFolderRelativeHTMLURL() ?>ANM22WebBase/website/plugins/<?= $this->elementPlugin ?>/css/arrow-slideshow.css" type="text/css" rel="stylesheet" />
<script>
$(function(){
  var slides = 0;
  var wrapper = ".com_anm22_wb_slideshow_com_anm22_wb_editor_slideshowV2";
  var leftArrow = wrapper + " .slideshow-arrow-left";
  var slider = wrapper + " .slideshow-slider-scroll";
  var rightArrow = wrapper + " .slideshow-arrow-right";
  var container = slider + " .slideshow-slider-extended-container";
  var slide = container + " .slideshow-slide";
  var mobileLimit = 900;
  var desktopWidth = parseInt("<?= $this->widthDesktop ?>");
  var mobileWidth = parseInt("<?= $this->widthMobile ?>");
  var desktopPadding = parseFloat("<?= $this->paddingDesktop ?>");
  var mobilePadding = parseFloat("<?= $this->paddingMobile ?>");
  var ratio = parseFloat("<?= $this->ratio ?>");
  var slideDuration = 250;
  var tokenLast = false;
  var tokenEv = false;

  $(slide).each(function(index, element){
    slides++;
  });

  if($(window).width()>mobileLimit){
    $(container).width(desktopWidth*slides + desktopPadding*slides*2);
    $(slide).each(function(){
      $(this).width(desktopWidth);
      $(this).css("margin", "0 " + desktopPadding + "px");
    });
    $(wrapper).height($(slide).width() * ratio);
  } else {
    $(container).width(mobileWidth*slides + mobilePadding*slides*2);
    $(slide).each(function(){
      $(this).width(mobileWidth);
      $(this).css("margin", "0 " + mobilePadding + "px");
    });
    $(wrapper).height($(slide).width() * ratio);
  }

  $(window).resize(function(){
    if($(window).width()>mobileLimit){
      $(container).width(desktopWidth*slides + desktopPadding*slides*2);
      $(slide).each(function(){
        $(this).width(desktopWidth);
        $(this).css("margin", "0 " + desktopPadding + "px");
      });
      $(wrapper).height($(slide).width() * ratio);
    } else {
      $(container).width(mobileWidth*slides + mobilePadding*slides*2);
      $(slide).each(function(){
        $(this).width(mobileWidth);
        $(this).css("margin", "0 " + mobilePadding + "px");
      });
      $(wrapper).height($(slide).width() * ratio);
    }
  });

  $(rightArrow).click(function(e){
    scrolledLast = $(slider).scrollLeft();
    if(!tokenLast){
      tokenLast = true;
      if($(window).width()>mobileLimit){
        maxScrollLast = ($(container).width()-$(slider).width());
        if(desktopWidth + $(slider).scrollLeft() <= maxScrollLast){
          scrolledLast += desktopWidth;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        } else {
          scrolledLast = maxScrollLast;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        }
      } else {
        maxScrollLast = ($(container).width()-$(slider).width());
        if(mobileWidth + $(slider).scrollLeft() <= maxScrollLast){
          scrolledLast += mobileWidth;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        } else {
          scrolledLast = maxScrollLast;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        }
      }
    }
  });

  $(leftArrow).click(function(e){
    scrolledLast = $(slider).scrollLeft();
    if(!tokenLast){
      tokenLast = true;
      if($(window).width()>mobileLimit){
        maxScrollLast = 0;
        if($(slider).scrollLeft() - desktopWidth >= maxScrollLast){
          scrolledLast -= desktopWidth;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        } else {
          scrolledLast = maxScrollLast;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        }
      } else {
        maxScrollLast = 0;
        if($(slider).scrollLeft() - mobileWidth >= maxScrollLast){
          scrolledLast -= mobileWidth;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        } else {
          scrolledLast = maxScrollLast;
          $(slider).animate({scrollLeft : scrolledLast}, slideDuration);
          tokenLast = false;
        }
      }
    }
  });

  $(slider).perfectScrollbar();
  
});
  </script>
  <div class="<?= $this->elementPlugin . "_" . $this->elementClass ?><? if ($this->cssClass != "") { ?><?= $this->cssClass ?><? } ?>">
    <div class="slideshow-arrow slideshow-arrow-left">
    </div>
    <div class="slideshow-slider-scroll">
      <div class="slideshow-slider-extended-container">
        <?php
        $gallery = $galleriesContainer->getGalleryById($this->galleryId)->getImagesArray();
        $i;
        for ($i = 1; $i <= count($gallery); $i++) {
          ?>
          <div style="background-image: url('<?= $this->page->getHomeFolderRelativeHTMLURL() ?>img/<?= $gallery[$i-1]->getPermalink() ?>_thumb/')" class="slideshow-slide slide-<?= $i ?>">
          </div>
          <?php
        }
        ?>
      </div>
    </div>
    <div class="slideshow-arrow slideshow-arrow-right">
    </div>
  </div>
<?php
?>
