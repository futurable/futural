$(document).ready(function(){
    
    $("#Company_industry_id").change(function(){
        updateIndustryDescription();
        updateSalaries();
        updateTurnover();
    })

    $("#Company_employees").change(function(){
        updateSalaries();
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
    
    updateTurnover = function(){
        var industryId = $("#Company_industry_id").val();
        var industrySetup = IndustrySetupArray[industryId];
        
        var turnover = industrySetup['turnover'];
        
        $("#CostbenefitItem_turnover_value").val(turnover);
        $("#_turnoveryearly").val(turnover*12);
    }
});