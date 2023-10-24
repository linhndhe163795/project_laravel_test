function ResetInput() {
    document.getElementById('name').value = '';
}

function Delete_team(button) {
    var id = button.getAttribute("data-id");
    console.log(id);
    var confirmDelete = confirm('Do you want to remove this team id = ' + id);
    if (confirmDelete) {
        // document.getElementById('id').value = id;
        document.getElementById('form_delete_' + id).submit();
    }
}