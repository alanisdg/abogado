/*----------  Uppercase  ----------*/
function upperCase(e) {
    e.value = e.value.toUpperCase();
}
/*Fuction disable button before sumit*/
$("#form").closest('form').on('submit', function(e) {
    e.preventDefault();
    $('#send').attr('disabled', true);
    $('#cancel').attr('disabled', true);
    this.submit();
});
