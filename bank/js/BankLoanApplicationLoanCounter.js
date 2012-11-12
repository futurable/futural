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
		else { repaymentInterval = 0; }

		var days = 365; // TODO: get leap year
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
		var termInDays = term * repaymentInterval;
		fillLoanCounterFrame( loanAmount, realAmount, repayment, termInDays );
		
	};
	
	fillLoanCounterFrame = function( loanAmount, realAmount, repayment, termInDays ){
		if( $.isNumeric(loanAmount) && $.isNumeric(realAmount) && $.isNumeric(repayment) && $.isNumeric(termInDays) ){
			prettyTerm = formatTermToHumanReadable( termInDays );
			
			$("#loanAmountTd").text( loanAmount + " €" );
			$("#interestAmountTd").text( Math.round((realAmount-loanAmount)*100) / 100 + " €" );
			$("#realAmountTd").text( Math.round(realAmount*100) / 100 + " €" );
			$("#repaymentTd").text( Math.round(repayment*100) / 100 + " €" );
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
		
		var years = 0;
		var months = 0;
		var days = 0;
		
		// Years
		if(term > 365){
			years = Math.floor(term / 365);
			term = term - years * 365;
		}
		// Months
		if(term > 30){
			months = Math.floor(term / 30);
			term = term - months * 30;
		}
		// Days
		if(term > 0){
			// Don't print days when repayment interval is month
			if( interval == "month" ){
				months++;
				days = 0;
			}
			else{
				days = Math.ceil(term);
			}
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
	
	$("#loanApplicationForm input").keyup(function(){
		// Amount is numeric
		if( $.isNumeric( $("#loanAmount").val() ) ){
			loanCounter();
		}
	});
	$("#loanApplicationForm select").change(function(){
		// Amount is numeric
		if( $.isNumeric( $("#loanAmount").val() ) ){
			loanCounter();
		}
	});
	
});