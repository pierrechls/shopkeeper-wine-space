<div id="header-loader">
    <div id="header-loader-under-bar"></div>
</div>

<script type="text/javascript">
    
    NProgress.configure({
        template: '<div class="bar" role="bar"></div>',
        parent: '#header-loader',
        showSpinner: false,
        easing: 'ease',
        minimum: 0.3,
        speed: 500,
    });

    NProgress.start();

</script>