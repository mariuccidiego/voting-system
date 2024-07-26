<script>
    $(document).ready(function(){
        var url = window.location.href;
        // Aggiunge la classe active al link corrispondente e all'elemento <li> parent
        $('.nav-link.sidebar-link').each(function() {
            if (this.href === url) {
                $(this).addClass('active');
                $(this).closest('li').addClass('active');
            }
        });

        // Per treeview (se hai sotto-menu)
        $('.treeview-menu a').each(function() {
            if (this.href === url) {
                $(this).addClass('active');
                $(this).closest('li').addClass('active');
                $(this).parentsUntil(".sidebar-menu > .treeview-menu").addClass('menu-open').prev('a').addClass('active');
            }
        });
    });
    </script>