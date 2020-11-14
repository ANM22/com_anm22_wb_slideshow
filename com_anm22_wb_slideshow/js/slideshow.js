function com_anm22_wb_editor_slideshow_loop(element_id){
	var lastOffset = window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"];
	
	if (lastOffset >= window["com_anm22_wb_editor_slideshow_id_"+element_id+"_imgNumber"]) {
		window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"] = 1;
	} else {
		window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]++;
	}
	
	window["com_anm22_wb_editor_slideshow_id_"+element_id+"_loopN"]++;
	
	document.getElementById("slideshow_id_"+element_id+"_b"+lastOffset+"_selected").style.display = "none";
	document.getElementById("slideshow_id_"+element_id+"_b"+lastOffset).style.display = "inline";
	document.getElementById("slideshow_id_"+element_id+"_b"+window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]).style.display = "none";
	document.getElementById("slideshow_id_"+element_id+"_b"+window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]+"_selected").style.display = "inline";
	
	document.getElementById("slideshow_id_"+element_id+"_s"+window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]).style.zIndex = window["com_anm22_wb_editor_slideshow_id_"+element_id+"_loopN"];
	
	setTimeout(function(){ com_anm22_wb_editor_slideshow_loop(element_id); }, window["com_anm22_wb_editor_slideshow_id_"+element_id+"_milliseconds"]);
}

function com_anm22_wb_editor_slideshow_change(element_id, offset){
	var i;
	
	var lastOffset = window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"];
	
	window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"] = offset;
	
	window["com_anm22_wb_editor_slideshow_id_"+element_id+"_loopN"]++;
	
	document.getElementById("slideshow_id_"+element_id+"_b"+lastOffset+"_selected").style.display = "none";
	document.getElementById("slideshow_id_"+element_id+"_b"+lastOffset).style.display = "inline";
	document.getElementById("slideshow_id_"+element_id+"_b"+window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]).style.display = "none";
	document.getElementById("slideshow_id_"+element_id+"_b"+window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]+"_selected").style.display = "inline";
	
	document.getElementById("slideshow_id_"+element_id+"_s"+window["com_anm22_wb_editor_slideshow_id_"+element_id+"_offset"]).style.zIndex = window["com_anm22_wb_editor_slideshow_id_"+element_id+"_loopN"];
}