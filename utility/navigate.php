<script>
    function navigate(id, table) {
        if (confirm('Are you sure you want to delete?')) {
            return window.location.href = `../utility/delete.php?id=${id}&table=${table}`;
        }
    }
</script>