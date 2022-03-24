var is_form_submitted = false;
var myEvent = window.attachEvent || window.addEventListener;
var chkevent = window.attachEvent ? 'onbeforeunload' : 'beforeunload';
var confirmationMessage = '';
myEvent(chkevent, function(e) {
    console.log(chkevent);
    console.log(is_form_submitted);
    if (!is_form_submitted) {
        (e || window.event).returnValue = 'Are you sure ?';
        return confirmationMessage;
    }
});