$(document).ready(function(){
    // Turnover
    $("#CostbenefitItem_turnover_value").keyup(function(){
        var monthly = $("#CostbenefitItem_turnover_value").val();
        var yearly = monthly * 12;
        
        $("#turnover").val(yearly);
    });
    $("#turnover").keyup(function(){
       var yearly = $("#turnover").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_turnover_value").val(monthly);
    });
    
    // Salaries
    $("#CostbenefitItem_salaries_value").keyup(function(){
        var monthly = $("#CostbenefitItem_salaries_value").val();
        var yearly = monthly * 12;
       
        $("#salaries").val(yearly);
    });
    $("#salaries").keyup(function(){
       var yearly = $("#salaries").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_salaries_value").val(monthly);
    });
    
    // Expenses
    $("#CostbenefitItem_expenses_value").keyup(function(){
        var monthly = $("#CostbenefitItem_expenses_value").val();
        var yearly = monthly * 12;
       
        $("#expenses").val(yearly);
    });
    $("#expenses").keyup(function(){
       var yearly = $("#expenses").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_expenses_value").val(monthly);
    });
    
    // Loans
    $("#CostbenefitItem_loans_value").keyup(function(){
        var monthly = $("#CostbenefitItem_loans_value").val();
        var yearly = monthly * 12;
       
        $("#loans").val(yearly);
    });
    $("#loans").keyup(function(){
       var yearly = $("#loans").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_loans_value").val(monthly);
    });
    
    // Rents
    $("#CostbenefitItem_rents_value").keyup(function(){
        var monthly = $("#CostbenefitItem_rents_value").val();
        var yearly = monthly * 12;
       
        $("#rents").val(yearly);
    });
    $("#rents").keyup(function(){
       var yearly = $("#rents").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_rents_value").val(monthly);
    });
    
    // Communication
    $("#CostbenefitItem_communication_value").keyup(function(){
        var monthly = $("#CostbenefitItem_communication_value").val();
        var yearly = monthly * 12;
       
        $("#communication").val(yearly);
    });
    $("#communication").keyup(function(){
       var yearly = $("#communication").val();
       var monthly = yearly / 12;
       monthly = Math.round(monthly*100) / 100;
       
       $("#CostbenefitItem_communication_value").val(monthly);
    });

});