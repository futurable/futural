$(document).ready(function(){
	loanCounter = function(){
		var loanAmount = $("#loanAmount").val();
		var realAmount = 0;
		var interest = 0.05; // TODO: get from db
		var loanType = $("#loanType").val();
		var interval = $("#repaymentInterval").val();
		var interestType = $("#interestType").val();
		var repaymentInterval = 0;
		
		var repayment = 0;
		var term = 0;
		
		/** Helper variables **/
		// Repayment interval
		if(interval == "day"){ repaymentInterval = 1; }
		else if(interval == "week"){ repaymentInterval = 7; }
		else if(interval == "month"){ repaymentInterval = 30; }
		else if(interval == "year"){ repaymentInterval = 360; }
		else { repaymentInterval = 0; }

		var days = 360; // TODO: change to actual amount?
		var interestPart = interest / days * repaymentInterval;
		
		// Fixed repayment
		if( loanType == "fixedRepayment" ){
			repayment = $("#repayment").val();
			nominator = -Math.log( 1 - (interestPart * loanAmount) / repayment );
			denominator = Math.log( 1 + interestPart );
			term = nominator / denominator;
		}
		// Fixed instalment
		else if( loanType == "annuity" ){
			var term = $("#loanTerm").val();

			nominator = loanAmount * interestPart;
			denominator = 1 - ( 1 / Math.pow( 1 + interestPart, term ) );
			repayment = nominator / denominator;
		}
		
		realAmount = repayment * term;
		fillLoanCounterFrame( loanAmount, realAmount, repayment, term );
		
	};
	
	fillLoanCounterFrame = function( loanAmount, realAmount, repayment, term ){
		if( $.isNumeric(loanAmount) && $.isNumeric(realAmount) && $.isNumeric(repayment) && $.isNumeric(term) ){
			prettyTerm = formatTermToHumanReadable( term );
			var roundedRepayment = Math.round(repayment*100) / 100;
			var ceiledTerm = Math.ceil(term);
			
			if(ceiledTerm <= 25){
				$("#loanTerm").val( ceiledTerm );
			}
			else{
				$("#loanTerm").val( 25 );
			}
			$("#repayment").val( roundedRepayment );
			
			$("#loanAmountTd").text( loanAmount + " €" );
			$("#interestAmountTd").text( Math.round((realAmount-loanAmount)*100) / 100 + " €" );
			$("#realAmountTd").text( Math.round(realAmount*100) / 100 + " €" );
			$("#repaymentTd").text( roundedRepayment + " €" );
			$("#termTd").text( prettyTerm );
		}
		else{			
			$("#loanAmountTd").text( "--" );
			$("#interestAmountTd").text( "--" );
			$("#realAmountTd").text( "--" );
			$("#repaymentTd").text( "--" );
			$("#termTd").text( "--" );
		}
	};
	
	formatTermToHumanReadable = function( term ){
		var interval = $("#repaymentInterval").val();
		
		if(interval == "day"){ repaymentInterval = 1; }
		else if(interval == "week"){ repaymentInterval = 7; }
		else if(interval == "month"){ repaymentInterval = 30; }
		else if(interval == "year"){ repaymentInterval = 360; }
		else { repaymentInterval = 0; }
		term *= repaymentInterval;
		
		var years = 0;
		var months = 0;
		var days = 0;

		// Years
		if( interval == "year" ){
			years = Math.ceil(term / 360);
		}
		else{
			years = Math.floor(term / 360);
		}
		term -= years * 360;
		
		// Months
		if( interval == "day" ){
			months = Math.floor(term / 30);
		}
		else{
			months = Math.ceil(term / 30);
		}

		term -= months * 30;
		// Days
		if(term > 0){
			days = Math.ceil(term);
		}
		
		// Formatting
		prettyTerm = "";
		if( years > 0){
			prettyTerm += years + " " + repaymentIntervalTexts["year"] + " ";
		}
		if( months > 0){
			prettyTerm += months + " " + repaymentIntervalTexts["month"] + " ";
		}
		if( days > 0){
			prettyTerm += days + " " + repaymentIntervalTexts["day"] + " ";
		}
		
		return prettyTerm;
	};
	
	// Page load
	loanCounter();
	
	$("#loanApplicationForm input").keyup(function(){
			loanCounter();
	});
	$("#loanApplicationForm select").change(function(){
			loanCounter();
	});
	
});