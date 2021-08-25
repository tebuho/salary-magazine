function _(id) {
    return document.getElementById(id);
}

function submitForm() {
    _('mybtn').disabled = true;
    _('status').innerHTML = 'please wait...';

    let formdata = new FormData();
    formdata.append('name', _('name').value);
    formdata.append('email', _('email').value);
    formdata.append('message', _('message').value);

    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'example_parser.php');
    ajax.onreadystatechange = function() {
        if(ajax.readyState === 4 && ajax.status === 200) {
            console.log(ajax);
            if(ajax.statusText === 'OK') {
                _('myForm').innerHTML = '<h2>Thanks ' + _('name').value + ', your form has been submitted.</h2>';
            } else {
                ('status').innerHTML = ajax.responseText;
                _('mybtn').disabled = false;
            }
        }
    }
    ajax.send(formdata);
}