let mix = require('laravel-mix');

mix.browserSync({
   proxy: 'local.helpashevillebears.org' 
});

mix.js('public/js/site-features-public.js', 'public/js/min/site-features-public.min.js');