/**
 * Loan Term calculator
 * Uses German calculation technique (30 days a month, 360 days a year)
 */

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
		var termUnit = 0;
		
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
		else if( loanType == "fixedInstalment"){
			// TODO: count it with the actual formula
			instalment = $("#instalment").val();
			repayment = instalment;
			
			nominator = -Math.log( 1 - (interestPart * loanAmount) / repayment );
			denominator = Math.log( 1 + interestPart );
			term = nominator / denominator;
		}
		// Fixed instalment
		else if( loanType == "annuity" ){
			var loanTerm = $("#loanTerm").val();
			var termMultiplier = getTermMultiplier();
			
			loanDays = loanTerm * termMultiplier;
			term = loanDays / repaymentInterval;
			
			nominator = loanAmount * interestPart;
			denominator = 1 - ( Math.pow( 1 + interestPart, -term ) );
			repayment = nominator / denominator;
		}
		
		realAmount = repayment * term;
		fillLoanCounterFrame( loanAmount, realAmount, repayment, term );
		
		fillPaymentPlanFrame( loanAmount, repayment, term, repaymentInterval, interestPart );
		
	};
	
	fillLoanCounterFrame = function( loanAmount, realAmount, repayment, term ){
		if( $.isNumeric(loanAmount) && $.isNumeric(realAmount) && $.isNumeric(repayment) && $.isNumeric(term) ){
			prettyTerm = formatTermToHumanReadable( term );
			var roundedRepayment = Math.round(repayment*100) / 100;
			
			// Set annuity loan vars
			setAnnuityVars(term);
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
	
	fillPaymentPlanFrame = function( loanAmount, repayment, term, repaymentInterval, interest ){
		if( $.isNumeric(loanAmount) && $.isNumeric(repayment) && $.isNumeric(term) && $.isNumeric(repaymentInterval) && $.isNumeric(interest) ){
	
			var repaymentNumber = 0;
			var instalmentAmount;			
			var interestAmount;
			var repaymentAmount = repayment;

			var loanType = $("#loanType").val();
			var loanCounterContent = "<tr class='paymentPlanTr'>" + $('#paymentPlanTable tr:first').html() + "</tr>";
			
			while(loanAmount > 0){
				repaymentNumber++;
				
				interestAmount = loanAmount * interest;
				if(repaymentAmount > (loanAmount+interestAmount)){ repaymentAmount = loanAmount+interestAmount};
				instalmentAmount = repaymentAmount - interestAmount;
				
				//loanAmount += interestAmount;
				loanAmount -= instalmentAmount;
				loanAmount = Math.round(loanAmount*1000) / 1000;
				
				loanCounterContent +=
				'<tr class=\'paymentPlanTr\'>'
					+ '<td>' + repaymentNumber + '.</td>'
					+ '<td>' + (Math.round(instalmentAmount*100) / 100) + ' &euro;</td>'
					+ '<td>' + (Math.round(interestAmount*100) / 100) + ' &euro;</td>'
					+ '<td>' + (Math.round(repaymentAmount*100) / 100) + ' &euro;</td>'
					+ '<td>' + (Math.round(loanAmount*100) / 100) + ' &euro;</td>'
				+ '</tr>';
			}
			
			$('#paymentPlanTable').html( loanCounterContent );
		}
		else{
			var loanCounterContent = "<tr class='paymentPlanTr'>" + $('#paymentPlanTable tr:first').html() + "</tr>";
			$('#paymentPlanTable').html( loanCounterContent );
		}
	}
	
	formatTermToHumanReadable = function( term ){
		var interval = $("#repaymentInterval").val();
		var repaymentInterval = getRepaymentInterval();
		term = Math.ceil( term * repaymentInterval);
		
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
	
	setAnnuityVars = function(term){
		var repaymentInterval = getRepaymentInterval();
		term *= repaymentInterval;
		
		var loanTerm = 0;
		var loanTermUnit = null;
		
		if(term <= 30){ // Use days if applicable
			loanTermUnit = 'day';
			loanTerm = Math.ceil(term);
		}
		else if(term <= 900){ // 30 months = 900 days
			loanTermUnit = 'month';
			loanTerm = Math.ceil(term/30);
		}
		else{ // Use years for long loans
			loanTermUnit = 'year';
			loanTerm = Math.ceil(term/360);
		}
		
		$("#loanTerm").val(loanTerm);
		$("#loanTermUnit").val(loanTermUnit);
	};
	
	getRepaymentInterval = function(){
		var interval = $("#repaymentInterval").val();
		
		if(interval == "day"){ repaymentInterval = 1; }
		else if(interval == "week"){ repaymentInterval = 7; }
		else if(interval == "month"){ repaymentInterval = 30; }
		else if(interval == "year"){ repaymentInterval = 360; }
		else { repaymentInterval = 0; };
		
		return repaymentInterval;
	};
	
	getTermMultiplier = function(){
		var termUnit = $("#loanTermUnit").val();
		
		if(termUnit == "day"){ termMultiplier = 1; }
		else if(termUnit == "week"){ termMultiplier = 7; }
		else if(termUnit == "month"){ termMultiplier = 30; }
		else if(termUnit == "year"){ termMultiplier = 360; }
		else{ termMultiplier = 0; }
		
		return termMultiplier;
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