/*
 * Disables enter (in forms)
 *
 * How to use:
 * Add your input field: onkeypress="return disableEnterKey(event)"
 *
 * @param: e	typically event
 */
function disableEnterKey(e)
{
     var key;     
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox     

     return (key != 13);
}