function navigate(id, table) {
    if (confirm('Are you sure you want to delete?')) {
        window.location.href = `../utility/delete.php?id=${id}&table=${table}`;
        return;
    }
}