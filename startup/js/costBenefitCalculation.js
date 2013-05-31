$(document).ready(function(){
    
    $("#Company_industry_id").change(function(){
        updateIndustryDescription();
        updateSalaries();
        updateSideExpenses();
        updateTurnover();
        updateExpenses();
        updateRents();
        updateCommunication();
        updateLoans();
        updateHealth();
        updateOther();
    })

    $("#Company_employees").change(function(){
        updateSalaries();
        updateSideExpenses();
    })
    
    $("#costBenefitCalculationTable input").keyup(function(){
        updateCalculationFields($(this));
    });
    
    /**
     * Update cost-benefit calculation fields
     * from monthly to yearly and vice versa
     * 
     * @param {object} field
     */
    updateCalculationFields = function( field ){
        var currentId = field.attr('id');
        
        // Check if variable isn't an object
        if(currentId.substring(0,1) === "_"){
            updateMonthlyField(field);
        }
        else{
            updateYearlyField(field);
        }
    };
    
    /**
     * Update cost-benefit calculation monthly field
     * using yearly value
     * 
     * @param {object} field
     */
    updateMonthlyField = function( field ){
        var currentValue = field.attr('value');
        var currentId = field.attr('id');
        var monthlyValue = Math.round(currentValue/12*100) / 100;
        
        var monthlyId = "#CostbenefitItem"+currentId.replace("yearly","")+"_value";
        $(monthlyId).val(monthlyValue);
    };
    
     /**
     * Update cost-benefit calculation yearly field
     * using monthly value
     * 
     * @param {object} field
     */
    updateYearlyField = function( field ){
        var currentValue = field.attr('value');
        var currentId = field.attr('id');
        var yearlyValue = currentValue * 12;
        
        var yearlyId = "#_"+currentId.split('_')[1]+"yearly";
        $(yearlyId).val(yearlyValue);
    };
    
    updateIndustryDescription = function(){
        var descval = $("#Company_industry_id").val();
        $("#Company_industry_description").text( IndustryDescriptionArray[descval] );
    }
    
    updateSalaries = function(){
        var employees = $("#Company_employees option:selected").text();
        var industryId = $("#Company_industry_id").val();
        var industrySetup = IndustrySetupArray[industryId];

        var avgWage = industrySetup['avgWage'];
        
        var salaries = avgWage*employees;
        $("#CostbenefitItem_salaries_value").val(salaries);
        $("#_salariesyearly").val(salaries*12);
    }
    
    updateSideExpenses = function(){
        var salaries = $("#CostbenefitItem_salaries_value").val();
        var expenses = salaries * 0.3;
        
        $("#CostbenefitItem_sideExpenses_value").val(expenses);
        $("#_sideExpensesyearly").val(expenses*12);
    }
    
    updateTurnover = function(){
        var industryId = $("#Company_industry_id").val();
        var industrySetup = IndustrySetupArray[industryId];
        
        var turnover = industrySetup['turnover'];
        
        $("#CostbenefitItem_turnover_value").val(turnover);
        $("#_turnoveryearly").val(turnover*12);
    }
    
    updateExpenses = function(){
        var turnover = $("#CostbenefitItem_turnover_value").val();
        
        var expenses = turnover * 0.8;
        
        $("#CostbenefitItem_expenses_value").val(expenses);
        $("#_expensesyearly").val(expenses*12);
    }
    
    updateLoans = function(){
        var expenses = parseInt($("#CostbenefitItem_expenses_value").val());
        var salaries = parseInt($("#CostbenefitItem_salaries_value").val());
        var rents = parseInt($("#CostbenefitItem_rents_value").val());
        var communication = parseInt($("#CostbenefitItem_communication_value").val());
        
        // Calculate loan sum. 3x all expenses + one months expenses
        loanSum = (expenses+salaries+rents+communication)*3 + expenses;
        payment = loanSum * ( 0.0033 / (1 - Math.pow(1.0033, -36)));
        
        loans = Math.round(payment);
        
        $("#CostbenefitItem_loans_value").val(loans);
        $("#_loansyearly").val(loans*12);
    }
    
    updateRents = function(){
        var industryId = $("#Company_industry_id").val();
        var industrySetup = IndustrySetupArray[industryId];
        
        var rents = industrySetup['rents'];
        
        $("#CostbenefitItem_rents_value").val(rents);
        $("#_rentsyearly").val(rents*12);       
    }
    
    updateCommunication = function(){
        var industryId = $("#Company_industry_id").val();
        var industrySetup = IndustrySetupArray[industryId];
        
        var communication = industrySetup['communication'];
        
        $("#CostbenefitItem_communication_value").val(communication);
        $("#_communicationyearly").val(communication*12); 
    }
    
    updateHealth = function(){
        $("#CostbenefitItem_health_value").val(0);
        $("#_healthyearly").val(0);
    }
    
    updateOther = function(){
        $("#CostbenefitItem_other_value").val(0);
        $("#_otheryearly").val(0);
    }
});