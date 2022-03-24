var scrollId = '';
function findPatientDetail(value){
/*----------------- Search begin when the have some value -------------------*/	
if(value.length > 0){

	$(".sortable-item").each(function(e){
		var liId = $(this).attr("id");
		var liText = $(this).text().toLowerCase(); 
		var findText = value.toLowerCase()
		/*---- If text found  ---*/
		if(liText.indexOf(findText)>=0){  

			$(this).css("background-color","#f78e1e");
			$(this).find("span, strong").each(function(obj){
			       	$(this).css("color","#fff");
			});
			scrollId = liId;
		/*----  If Not Found ------*/
		}else{ 

		   if($(this).attr("style")){ 
		   		$(this).removeAttr("style");
			}

			$(this).find("span, strong").each(function(obj){
			       if($(this).is("span")){
			     		$(this).css("color","#959ca1");
			    	}else{
				       $(this).css("color","#f78e1e");
			 		}
			});
		}

	});
	goToByScroll(scrollId);

}else{//If value is not >0 the check the css and reset it.
 

/*----------------- Code to reset the css if value length is < 0 ------------------------*/
		$(".sortable-item").each(function(e){
			if($(this).attr("style")){ 
			   $(this).removeAttr("style");
			}
			$("#search_btn_form").css({
									'position' : 'relative'
								});
			$(this).find("span, strong").each(function(obj){
			       if($(this).is("span")){
			     		$(this).css("color","#959ca1");
			    	}else{
				       $(this).css("color","#f78e1e");
			 	}


			});
		});

}

}


/*---------- This is a functions that scrolls to #{blah}link  --------------*/
function goToByScroll(id){
      // Remove "link" from the ID
     /* $("#search_btn_form").css({
									'position' : 'fixed',
									'z-index' : '99',
									'top' : '50px',
									'right' : '53px'
							});*/

    id = id.replace("link", "");
      // Scroll
	    $('html,body').animate({
	       scrollTop: $("#"+id).offset().top - 100},
	       'slow');
}
/*

z-index: 99;
position: fixed;
*/