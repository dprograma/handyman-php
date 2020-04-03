<?php

if($loggedin == 1){
?>
<script src="../../assets/css/mmenu-js-master/dist/mmenu.js"></script>
    <script>
        Mmenu.configs.classNames.selected = "active";
        Mmenu.configs.offCanvas.page.selector = "#my-page";

        document.addEventListener(
            "DOMContentLoaded", () => {
                const menu = new Mmenu("#my-menu", {
                    slidingSubmenus: true,
                    extensions: ["theme-dark"]
                });
            }
        );
    </script>
</body>

</html>
<?php
} else {
    header("location:{$redirectUrl}/view/login/");
}
?>