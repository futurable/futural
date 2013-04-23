/*
 *	Hides and shows div.
 *
 * @param	id		divs id which want to be hide or show
 */
function hideAndShowDiv(id) {
	var state = document.getElementById(id).style.display;
	if (state == 'block') {
		document.getElementById(id).style.display = 'none';
	} else {
		document.getElementById(id).style.display = 'block';
	}
}
