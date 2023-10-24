
function ResetInput() {
    if (document.getElementById('name') != null) {
        document.getElementById('name').value = '';
    }
    if (document.getElementById('email') != null) {
        document.getElementById('email').value = '';
    }
    if (document.getElementById('password') != null) {
        document.getElementById('password').value = '';
    }
    if (document.getElementById('address') != null) {
        document.getElementById('address').value = '';
    }
    if (document.getElementById('salary') != null) {
        document.getElementById('salary').value = '';
    }
    if (document.getElementById('last_name') != null) {
        document.getElementById('last_name').value = '';
    }
    if (document.getElementById('first_name') != null) {
        document.getElementById('first_name').value = '';
    }

}
function Delete_team(button) {
    var id = button.getAttribute("data-id");
    console.log(id);
    var confirmDelete = confirm('Do you want to remove this employee id = ' + id);
    if (confirmDelete) {
        // document.getElementById('id').value = id;
        document.getElementById('form_delete_' + id).submit();
    }
}
    document.getElementById('avatar_image').addEventListener('change', function () {
        const fileInput = this;
        const hiddenInput = document.getElementById('avatar_image_hidden');
        if (fileInput.files.length > 0) {
            var file = fileInput.value.split('\\');
            var imageName = file.pop();
            hiddenInput.value = imageName;
        } else {
            hiddenInput.value = '';
        }
    });
function goBack() {
    history.back();
}