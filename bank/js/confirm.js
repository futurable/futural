/*
 * Confirms button pushing (like 'Are you sure?')
 *
 * @param	text		text which you want to confirm box
 */
function confirmBack( text ) {
	var confirmationText = text;
	return confirm(confirmationText);
}