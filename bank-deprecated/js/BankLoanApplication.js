$(document).ready(function(){
	$(".instalment").hide();
	$(".loanTermSelect").hide();
	// Loanterm suffix
	//$( "#loanTermDiv").append( "<p id='repaymentIntervalText'>" + $("#repaymentInterval").val() + "</p>" );

	toggleFields = function(){
		// Show repayment
		if($("#loanType").val() == "fixedRepayment"){
			$(".repayment").fadeIn("slow");
			if($(".instalment").is(":visible")){ $(".instalment").hide(); }
			if($(".loanTermSelect").is(":visible")){ $(".loanTermSelect").hide(); }
		}
		// Show instalment
		if($("#loanType").val() == "fixedInstalment"){
			if($(".repayment").is(":visible")){ $(".repayment").hide(); }
			$(".instalment").fadeIn("slow");
			if($(".loanTermSelect").is(":visible")){ $(".loanTermSelect").hide(); }
		}
		// Show term
		if($("#loanType").val() == "annuity"){
			if($(".repayment").is(":visible")){ $(".repayment").hide(); }
			if($(".instalment").is(":visible")){ $(".instalment").hide(); }
			$(".loanTermSelect").fadeIn("slow");
			
			// Loanterm suffix
			//var selected =  $("#repaymentInterval option:selected").val();
			//$( "#repaymentIntervalText" ).text( repaymentIntervalTexts[selected] );
		}
	};
	
	// Toggling required fields
	toggleFields();
	$("#loanType").change(function(){
		toggleFields();
	});

	$("#repaymentInterval").change(function(){
		//var selected =  $("#repaymentInterval option:selected").val();
		//$( "#repaymentIntervalText" ).text( repaymentIntervalTexts[selected] );
	});

	/* Loan term slider
	$(function() {
		$( "#loanTermSlider" ).slider({
    		min: 5,
    		max: 30,
    		value: 5,
    		slide: function( event, ui ) {
     			$( "#loanTerm" ).val( ui.value );
     			$( "#loanTermRange" ).text( $("#repaymentInterval option:selected").text() + "s" );
    		}
		});
 		$( "#loanTerm" ).val( $( "#loanTermSlider" ).slider( "value" ) );
 		$( "#loanTermRange" ).text( $("#repaymentInterval option:selected").text() + "s" );
	});
	//*/

	/*/ Form validation
	$("#loanApplicationForm").validate({
		rules: {
			loanAmount: {
				required: true,
				number: true
			},
			repayment: {
				number: true
			},
			instalment: {
				number: true
			},
			loanTerm: {
				digit: true,
				min: 5,
				max: 30
			}
		}
	});//*/
	
	// Tooltips
	$(function() {
		$( document ).tooltip();
	});
});