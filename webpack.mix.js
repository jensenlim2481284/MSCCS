const mix = require('laravel-mix');



/************************************************ 
    
                    WEBSITE

************************************************/


mix.styles([
    'public/css/plugin/animate.min.css',
    'public/css/plugin/bootstrap.min.css',
    'public/css/plugin/themify.css',
    'public/css/page/general.css',
    'public/css/page/website/index.css',
], 'public/css/prod/website/index.min.css');

mix.scripts([
    'public/js/plugin/jquery.min.js',
    'public/js/plugin/sweetalert.min.js',
    'public/js/plugin/wow.min.js',
    'public/js/plugin/fontfile.js',
    'public/js/page/general.js',
], 'public/js/prod/website/index.min.js')





/*****************************************************

                 MSCCS WEBPACK

*****************************************************/

mix.styles(
    [
        "public/css/plugin/animation.css",
        "public/css/page/msccs/nav.css",
        "public/css/page/msccs/index.css",
        "public/css/page/general.css",
        "public/css/page/component/chart.css",
        "public/css/plugin/chart.min.css",
        "public/css/page/component/panel.css",
    ],
    "public/css/prod/msccs/index.min.css"
);

mix.scripts(
    [
        "public/js/page/msccs/nav.js",
        "public/js/plugin/chart.min.js",
        "public/js/page/msccs/index.js",        
        "public/js/page/general.js"
    ],
    "public/js/prod/msccs/index.min.js"
);





/*****************************************************

                 COMPONENT WEBPACK

*****************************************************/

mix.styles(
    [
        "public/css/page/component/form.css",
        "public/css/page/component/modal.css",
        "public/css/plugin/flatpickr.min.css",
        "public/css/page/component/table.css"
    ],
    "public/css/prod/component/table.min.css"
);

mix.scripts(
    [
        "public/js/page/component/table.js",
        "public/js/plugin/flatpickr.min.js",
    ],
    "public/js/prod/component/table.min.js"
);


mix.scripts(
    [
        "public/js/plugin/jquery.min.js",
        "public/js/plugin/popper.min.js",
        "public/js/plugin/bootstrap.min.js",
        "public/js/plugin/sweetalert.min.js",
        "public/js/plugin/jquery.nicescroll.min.js",
        "public/js/plugin/toastify.js",
        "public/js/plugin/tooltipster.bundle.min.js",
    ],
    "public/js/prod/component/general.min.js"
);

mix.styles(
    [
        "public/css/plugin/themify/themify.css",
        "public/css/plugin/animate.min.css",
        "public/css/plugin/toastify.css",
        "public/css/plugin/bootstrap.min.css",
        "public/css/plugin/tooltipster.bundle.min.css",
        "public/css/plugin/fontawesome/fontawesome.css"
    ],
    "public/css/prod/component/general.min.css"
);
