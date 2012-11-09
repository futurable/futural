$(document).ready(function(){
	loanCounter = function(){
		var loanAmount = $("#loanAmount").val();
		var realAmount = 0;
		var interest = 0.05; // TODO: get from db
		var loanType = $("#loanType").val();
		var interval = $("#repaymentInterval").val();
		var interestType = $("#interestType").val();
		var interestAmount = 0;
		
		var repayment = 0;
		var instalment = 0; //$("#instalment").val();
		var term = 0; //$("#loanTerm").val();
		
		
		/** Helper variables **/
		// Repayment interval
		if(interval == "day"){ var repaymentInterval = 1; }
		else if(interval == "week"){ var repaymentInterval = 7; }
		else if(interval == "month"){ var repaymentInterval = 30; }
		else { var repaymentInterval = 0; }

		var days = 365; // TODO: get leap year
		var loanRemaining = loanAmount;
		var interestPart = interest / days * repaymentInterval;
		
		// Fixed repayment
		if( loanType = "fixedRepayment" ){
			var repayment = $("#repayment").val();
			nominator = -Math.log( 1 - (interestPart * loanAmount) / repayment );
			denominator = Math.log( 1 + interestPart );
			term = nominator / denominator;
			
			realAmount = repayment * term;
			var realInterest = realAmount - loanAmount;
			var interestAmount = realInterest / term;
			instalment = repayment - interestAmount;
			
			fillLoanCounterFrame( loanAmount, realAmount, repayment, interestAmount, instalment, term );
		}
	};
	
	fillLoanCounterFrame = function( loanAmount, realAmount, repayment, interestAmount, instalment, term ){ 
		$("#loanAmountTd").text( loanAmount );
		$("#realAmountTd").text( Math.round(realAmount*100) / 100 );
		$("#repaymentTd").text( repayment );
		$("#interestTd").text( Math.round(interestAmount*100) / 100 );
		$("#instalmentTd").text( Math.round(instalment*100) / 100 );
		$("#termTd").text( Math.round(term*100) / 100 );
	};
	
	$("#loanApplicationForm input").keyup(function(){
			loanCounter();
	});
	$("#loanApplicationForm select").change(function(){
			loanCounter();
	});
	
});