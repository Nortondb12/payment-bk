<script type="module">
    $(document).on("click", "#copy", async function () {
        var text = $(this).data("text");
        try {
            await navigator.clipboard.writeText(text);
            toastr.success("Copied!");
        } catch (err) {
            console.error("Failed to copy text:", err);
        }
    });
</script>
