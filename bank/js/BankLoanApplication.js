$(document).ready(function(){
	$(".instalment").hide();
	$(".loanTerm").hide();
	// Loanterm suffix
	$( "#loanTermDiv").append( "<p id='repaymentIntervalText'>" + $("#repaymentInterval").val() + "</p>" );

	// Toggling required fields
	$("#loanType").change(function(){
		// Show repayment
		if($("#loanType").val() == "fixedRepayment"){
			$(".repayment").fadeIn("slow");
			if($(".instalment").is(":visible")){ $(".instalment").hide(); }
			if($(".loanTerm").is(":visible")){ $(".loanTerm").hide(); }
		}
		// Show instalment
		if($("#loanType").val() == "fixedInstalment"){
			if($(".repayment").is(":visible")){ $(".repayment").hide(); }
			$(".instalment").fadeIn("slow");
			if($(".loanTerm").is(":visible")){ $(".loanTerm").hide(); }
		}
		// Show term
		if($("#loanType").val() == "annuity"){
			if($(".repayment").is(":visible")){ $(".repayment").hide(); }
			if($(".instalment").is(":visible")){ $(".instalment").hide(); }
			$(".loanTerm").fadeIn("slow");
			
			// Loanterm suffix
			var selected =  $("#repaymentInterval option:selected").val();
			$( "#repaymentIntervalText" ).text( repaymentIntervalTexts[selected] );
		}
	});

	$("#repaymentInterval").change(function(){
		var selected =  $("#repaymentInterval option:selected").val();
		$( "#repaymentIntervalText" ).text( repaymentIntervalTexts[selected] );
	});

	/*// Loan term slider
	$(function() {
		$( "#loanTermSlider" ).slider({
    		min: 5,
    		max: 30, 0       
    		 
    		 
    		  0
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