<?php
/*Big Image Slideshow*/
?>
<style>

.<?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?>{
  width: 100%;
  position: relative;
  box-sizing: border-box;
  padding: 0;
  margin: 0;
  font-size: 0;
  text-align: left;
}

.slideshow-big-image .big-image-<?= $this->id ?>{
  width: 100%;
  display: block;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  margin-bottom: 1%;
}

.slideshow-big-image .mini-image-<?= $this->id ?>{
  display: inline-block;
  width: 11.625%;
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  box-sizing: border-box;
  vertical-align:top;
  margin: 0 1% 1% 0;
  cursor: pointer;
}

.slideshow-big-image .mini-image-8-no-margin{
  margin: 0 0 1% 0;
}

@media only screen and (max-width: 900px){

  .slideshow-big-image .mini-image-<?= $this->id ?>{
    width: 15.833%;
  }

  .slideshow-big-image .mini-image-8-no-margin{
    margin: 0 1% 1% 0;
  }

  .slideshow-big-image .mini-image-6-no-margin{
    margin: 0 0 1% 0;
  }

}

@media only screen and (max-width: 600px){

  .slideshow-big-image .mini-image-<?= $this->id ?>{
    width: 24.25%;
  }

  .slideshow-big-image .mini-image-6-no-margin{
    margin: 0 1% 1% 0;
  }

  .slideshow-big-image .mini-image-4-no-margin{
    margin: 0 0 1% 0;
  }

}

</style>
<script>
$(function(){

  var bigImageClass = '.<?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?> .big-image-<?= $this->id ?>';
  var miniImageClass = '.<?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?> .mini-image-<?= $this->id ?>';
  var ratioBig = parseFloat("<?= $this->ratioBig ?>");
  var ratioMini = parseFloat("<?= $this->ratioMini ?>");
  var firstStep = 1100;
  var secondStep = 700;

  $(bigImageClass).height($(bigImageClass).width() * ratioBig);
  $(miniImageClass).height($(miniImageClass).width() * ratioMini);
  $(window).resize(function(event) {
    $(bigImageClass).height($(bigImageClass).width() * ratioBig);
    $(miniImageClass).height($(miniImageClass).width() * ratioMini);
  });

  $(miniImageClass).click(function(event) {
    $(bigImageClass).css("background-image", $(this).css("background-image"));
  });

});
</script>
<div class="<?= $this->elementPlugin . "-" . $this->elementClass ?> <?= $this->elementPlugin . "-" . $this->elementClass . "-" . $this->id ?> <?= $this->cssClass ?> slideshow-big-image">
  <?php
  $gallery = $galleriesContainer->getGalleryById($this->galleryId)->getImagesArray();
  $i;
  $first = 1;
  for ($i = 1; $i <= count($gallery); $i++) {
    if($first == 1){
      $first = 0;
      ?>
      <div class="big-image big-image-<?= $this->id ?>" style="background-image: url('<?=$this->page->getHomeFolderRelativeHTMLURL()?>img/<?= $gallery[$i-1]->getPermalink() ?>/');">
      </div>
      <?php
    }
    ?>
        <div class="mini-image-<?= $this->id ?> <?php if ($i%8 == 0) {?> mini-image-8-no-margin<?php } ?><?php if ($i%6 == 0) {?> mini-image-6-no-margin<?php } if ($i%4 == 0) { ?> mini-image-4-no-margin<?php } ?>" style="background-image: url('<?=$this->page->getHomeFolderRelativeHTMLURL()?>img/<?= $gallery[$i-1]->getPermalink() ?>_thumb/')"></div>
    <?php
  }
  ?>
</div>
