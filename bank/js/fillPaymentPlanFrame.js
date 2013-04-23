/**
 * fillPaymentPlanFrame
 * 
 * @param	loanAmount			decimal
 * @param	repaymentInterval	int
 * @param	interest			decimal
 * 
 */
fillPaymentPlanFrame = function( loanAmount, repaymentInterval, interest ){
	if( $.isNumeric(loanAmount) &&  $.isNumeric(repaymentInterval) && $.isNumeric(interest) ){

		var repaymentNumber = 0;
		var instalmentAmount;			
		var interestAmount;
		var repaymentAmount;
		loanAmount = Number(loanAmount);

		var loanType = $("#loanType").val();
		
		// Repayment types
		if( loanType == 'fixedRepayment' ){
			repaymentAmount = Number($("#repayment").val());
		}
		else if( loanType == 'fixedInstalment' ){
			instalmentAmount = Number($("#instalment").val());
		}
		else if( loanType == 'annuity' ){
			loanTerm =  Number($("#loanTerm").val());
			var termMultiplier = getTermMultiplier();
			
			loanDays = loanTerm * termMultiplier;
			term = loanDays / repaymentInterval;
			
			nominator = loanAmount * interest;
			denominator = 1 - ( Math.pow( 1 + interest, -term ) );
			repaymentAmount = nominator / denominator;
		}
		
		var loanCounterContent = "<tr class='paymentPlanTr'>" + $('#paymentPlanTable tr:first').html() + "</tr>";
		
		while(loanAmount > 0.01){ // Don't use 0 as the JS rounding functions are funky
			repaymentNumber++;
			
			interestAmount = loanAmount*interest;
			var loanWithInterest = parseFloat(loanAmount+interestAmount);
			
			if( loanType == 'fixedInstalment' ){
				repaymentAmount = instalmentAmount + interestAmount;
			}
			
			if(instalmentAmount <= 0){ break; }; // Don't count if instalment is zero or negative
			
			if(repaymentAmount >= loanWithInterest){ repaymentAmount = loanAmount+interestAmount; };
			instalmentAmount = repaymentAmount - interestAmount;
			
			loanAmount = loanAmount + interestAmount;
			loanAmount -= repaymentAmount;
			loanAmount = Math.round(loanAmount*1000) / 1000;
			
			loanCounterContent +=
			'<tr class=\'paymentPlanTr\'>'
				+ '<td>' + repaymentNumber + '.</td>'
				+ '<td>' + (parseFloat(instalmentAmount).toFixed(2)) + ' &euro;</td>'
				+ '<td>' + (parseFloat(interestAmount).toFixed(2)) + ' &euro;</td>'
				+ '<td>' + (parseFloat(repaymentAmount).toFixed(2)) + ' &euro;</td>'
				+ '<td>' + (parseFloat(loanAmount).toFixed(2)) + ' &euro;</td>'
			+ '</tr>';
			
			if(repaymentNumber >= 300){ // Break if loan longer than 25*12 (25 years with monthly repayment)
				loanCounterContent += '<tr class=\'paymentPlanTr\'><td colspan="5">...</td>';
				break;
			}
		}
		
		$('#paymentPlanTable').html( loanCounterContent );
	}
	else{
		var loanCounterContent = "<tr class='paymentPlanTr'>" + $('#paymentPlanTable tr:first').html() + "</tr>";
		$('#paymentPlanTable').html( loanCounterContent );
	}
};